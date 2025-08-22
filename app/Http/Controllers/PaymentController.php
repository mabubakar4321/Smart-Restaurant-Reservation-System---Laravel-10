<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
 public function index()
    {
        $payments = Payment::with('reservation')->latest()->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $reservations = Reservation::all();
        return view('payments.create', compact('reservations'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Paid'
        ]);

        Payment::create([
            'reservation_id' => $request->reservation_id,
            'amount' => $request->amount,
            'payment_method' => 'Cash',
            'status' => $request->status
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment added successfully.');
    }
public function edit($id)
{
    $payment = Payment::findOrFail($id);
    $reservations = Reservation::all();

    return view('payments.edit', compact('payment', 'reservations'));
}

     public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Paid'
        ]);

        $payment->update([
            'reservation_id' => $request->reservation_id,
            'amount' => $request->amount,
            'status' => $request->status
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
