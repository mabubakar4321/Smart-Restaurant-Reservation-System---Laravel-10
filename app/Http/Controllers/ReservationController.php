<?php

namespace App\Http\Controllers;

    

use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index(Request $request)
{
    // Start a query with relationships
    $query = Reservation::with('table');

    // 1️⃣ Search filter (by customer name or phone)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('customer_name', 'LIKE', "%{$search}%")
              ->orWhere('customer_phone', 'LIKE', "%{$search}%");
        });
    }

    // 2️⃣ Status filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // 3️⃣ Order results (latest first)
    $reservations = $query->orderByDesc('reservation_date')
                          ->orderByDesc('reservation_time')
                          ->get();

    return view('reservations.index', compact('reservations'));
}

    public function create()
    {
        $tables = Table::where('status', 'Available')->orderBy('name')->get();
        return view('reservations.create', compact('tables'));
    }




public function store(Request $request)
{
    $data = $request->validate([
        'table_id' => 'required|exists:tables,id',
        'reservation_date' => 'required|date|after_or_equal:today',
        'reservation_time' => 'required',
        'duration' => 'required|integer|min:15',
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:50',
    ]);

    // Build start & end Carbon objects
    $start = Carbon::createFromFormat(
        'Y-m-d H:i',
        $data['reservation_date'] . ' ' . substr($data['reservation_time'], 0, 5)
    );
    $end = $start->copy()->addMinutes($data['duration']);

    // Check table availability (no overlap)
    if (! $this->isTableAvailable($data['table_id'], $start, $end)) {
        return back()->withInput()->withErrors([
            'table_id' => 'Selected table is not available at this date/time.'
        ]);
    }

    // Create reservation
    $reservation = Reservation::create($data);

    // Mark the table as Reserved
    $reservation->table()->update(['status' => 'Reserved']);

    // Get total tables count
    $totalTables = Table::count();

    return redirect()
        ->route('reservations.index')
        ->with('success', "Reservation created successfully. Total tables: {$totalTables}");
}

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);

        $tables = Table::where('status', 'Available')
            ->orWhere('id', $reservation->table_id)
            ->orderBy('name')
            ->get();

        return view('reservations.edit', compact('reservation', 'tables'));
    }

    // update - validate, check availability (exclude current), update statuses
    public function update(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $data = $request->validate([
        'table_id' => 'required|exists:tables,id',
        'reservation_date' => 'required|date|after_or_equal:today',
        'reservation_time' => 'required',
        'duration' => 'required|integer|min:15',
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:50',
        'status' => 'required|string|in:Pending,Confirmed,Done', // Add if you want to update status
    ]);

    // Create start and end times using Carbon
    $start = Carbon::createFromFormat(
        'Y-m-d H:i',
        $data['reservation_date'] . ' ' . substr($data['reservation_time'], 0, 5)
    );
    $end = $start->copy()->addMinutes($data['duration']);

    // Check availability excluding current reservation
    if (! $this->isTableAvailable($data['table_id'], $start, $end, $reservation->id)) {
        return back()->withInput()->withErrors([
            'table_id' => 'Selected table is not available at this date/time.'
        ]);
    }

    // If table changed, update statuses accordingly
    if ($reservation->table_id != $data['table_id']) {
        // Free the old table
        Table::where('id', $reservation->table_id)->update(['status' => 'Available']);
        // Reserve the new table
        Table::where('id', $data['table_id'])->update(['status' => 'Reserved']);
    }

    // Update the reservation data
    $reservation->update($data);

    return redirect()
        ->route('reservations.index')
        ->with('success', 'Reservation updated successfully.');
}

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        // free linked table
        if ($reservation->table) {
            $reservation->table->update(['status' => 'Available']);
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted.');
    }


     private function isTableAvailable($tableId, Carbon $newStart, Carbon $newEnd, $exceptId = null)
    {
        $query = Reservation::where('table_id', $tableId);

        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }

        // Use MySQL TIMESTAMP of reservation_date + reservation_time and duration
        $existsOverlap = $query->whereRaw("
            TIMESTAMP(reservation_date, reservation_time) < ?
            AND DATE_ADD(TIMESTAMP(reservation_date, reservation_time), INTERVAL duration MINUTE) > ?
        ", [
            $newEnd->toDateTimeString(),
            $newStart->toDateTimeString()
        ])->exists();

        return ! $existsOverlap;
    }


}
