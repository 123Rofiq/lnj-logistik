<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Container;
use App\Transaction;
use Illuminate\Http\Request;
use Redirect,Response;
Use DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function transaksi_status() {
        $items = Customer::select(DB::raw('count(*) as jumlah, name'))
        ->groupBy('name')
        ->get();
     
        return response()->json([
            'data' => $items
        ]);
     }

     public function transaksi_status2() {
        $items = Container::select(DB::raw('count(*) as jumlah, janis'))
        ->groupBy('janis')
        ->get();
     
        return response()->json([
            'data' => $items
        ]);
     }

     public function transaksi_status3() {
        $items = Transaction::select(DB::raw('count(*) as jumlah, barang'))
        ->groupBy('barang')
        ->get();
     
        return response()->json([
            'data' => $items
        ]);
     }
}