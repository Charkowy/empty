<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->{Auth::user()->roles->first()->name}();
    }

    public function admin_sys()
    {
        //return $this->administrative();
        return redirect()->route('products.crud.index');
    }

    public function supplier()
    {
        //return redirect()->route('products.suppliers.index');
        return redirect()->route('users.profile.show');
    }

    /**
     * Display a listing of the resource.
     */
    public function administrative()
    {
       /*  $sales_grouped = Sale::groupByYearMonth()->get();

        $sales = $sales_grouped->mapWithKeys(function ($item, int $key) {
            return [($item['year'] . '-' . $item['month']) => $item['total']];
        });

        return view('dashboard', compact('sales')); */
    }
}
