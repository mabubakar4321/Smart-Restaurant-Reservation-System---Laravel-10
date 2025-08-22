<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
         $totalReservations = Reservation::count();
         $totalTables = Table::where('status','available')->count();
         $doneReservationsCount = Reservation::where('status', 'Done')->count();
         $pendingReservationsCount = Reservation::where('status', 'pending')->count();
          $totalamount = Payment::sum('amount');
        return view('AdminDashboard.dashboard',compact('totalReservations',
        'totalTables',
        'doneReservationsCount',
        'pendingReservationsCount',
        'totalamount'));
    }
}
