<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserReservationController extends Controller
{
    /**
     * Show user dashboard with tables and their reservations
     */
    public function index()
    {
        $tables = Table::all();

        // ✅ Fetch only logged-in user's reservations
        $reservations = Reservation::where('customer_name', Auth::user()->name)->get();

        return view('UserDashboard.index', compact('tables', 'reservations'));
    }

    /**
     * Store a new reservation
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'duration' => 'required|integer|min:15',
        ]);

        // ✅ Force customer_name to logged-in user
        $data['customer_name'] = Auth::user()->name;

        // Calculate reservation start & end
        $start = Carbon::createFromFormat(
            'Y-m-d H:i',
            $data['reservation_date'] . ' ' . substr($data['reservation_time'], 0, 5)
        );
        $end = $start->copy()->addMinutes($data['duration']);

        // Check overlap for the same table
        $overlap = Reservation::where('table_id', $data['table_id'])
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('reservation_time', [$start, $end]);
            })->exists();

        if ($overlap) {
            return back()->withErrors(['table_id' => 'Table is already reserved at this time.']);
        }

        // Create reservation
        $reservation = Reservation::create($data);

        // Update table status
        $reservation->table()->update(['status' => 'reserved']);

        return back()->with('success', 'Reservation created successfully.');
    }

    /**
     * Cancel reservation (delete)
     */
    public function destroy(Reservation $reservation)
    {
        // ✅ Allow cancel only if it belongs to logged-in user
        if ($reservation->customer_name !== Auth::user()->name) {
            return back()->withErrors(['error' => 'You are not authorized to cancel this reservation.']);
        }

        // Set table back to available
        $reservation->table()->update(['status' => 'available']);

        // Delete reservation
        $reservation->delete();

        return back()->with('success', 'Reservation cancelled and table is now available.');
    }
}
