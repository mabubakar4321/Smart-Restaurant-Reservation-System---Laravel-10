<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $totalReservations = Reservation::count();
        $totalRevenue = Payment::where('status', 'Paid')->sum('amount');

        $customers = Reservation::with('payment')->get();

        return view('reports.index', compact('totalReservations', 'totalRevenue', 'customers'));
    }

    public function exportReservations()
    {
        $reservations = Reservation::all();

        $filename = "total_reservations.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Customer Name', 'Email', 'Date', 'Time']);

        foreach ($reservations as $reservation) {
            fputcsv($handle, [
                $reservation->id,
                $reservation->customer_name,
                $reservation->customer_email ?? '',
                $reservation->reservation_date,
                $reservation->reservation_time
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function exportRevenue()
    {
        $payments = Payment::where('status', 'Paid')->get();

        $filename = "total_revenue.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Reservation ID', 'Amount', 'Status']);

        foreach ($payments as $payment) {
            fputcsv($handle, [
                $payment->id,
                $payment->reservation_id,
                $payment->amount,
                $payment->status
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function exportCustomers()
    {
        $customers = Reservation::with('payment')->get();

        $filename = "customers_with_reservations.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Customer Name', 'Email', 'Phone', 'Reservation Date', 'Amount', 'Payment Status']);

        foreach ($customers as $customer) {
            fputcsv($handle, [
                $customer->customer_name,
                $customer->customer_email ?? '',
                $customer->customer_phone ?? '',
                $customer->reservation_date,
                $customer->payment->amount ?? 0,
                $customer->payment->status ?? 'Not Paid'
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
