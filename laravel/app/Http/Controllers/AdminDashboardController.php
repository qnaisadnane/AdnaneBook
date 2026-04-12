<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(){
        $totalCommands = Order::count();

        $totalClients = User::where('role','client')->count();

        $totalRevenues = Order::whereIn('status',['paid','shipped','delivered'])->sum('total_price');

        $commandesParStatut = Order::select('status', DB::raw('count(*) as total'))->groupBy('status')->get();

        $meilleursLivres = OrderItem::select('book_id',DB::raw('SUM(quantity) as total_vendu'));

        return view('admin.dashboard', compact(
        'totalCommands',
        'totalClients', 
        'totalRevenues', 
        'commandesParStatut', 
        'meilleursLivres'
        ));
    }
}
