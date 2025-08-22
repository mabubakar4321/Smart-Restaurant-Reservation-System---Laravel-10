<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class CustomerController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Reservation::select('customer_name', 'customer_phone')->distinct()->latest();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('customer_name', 'like', "%{$search}%")
              ->orWhere('customer_phone', 'like', "%{$search}%");
        });
    }

    $customers = $query->paginate(15)->withQueryString();

    return view('AdminDashboard.customers.index', compact('customers'));
}
}

