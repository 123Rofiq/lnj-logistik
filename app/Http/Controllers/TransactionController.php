<?php

namespace App\Http\Controllers;

use App\Container;
use App\Customer;
use App\Transaction;
use Illuminate\Http\Request;
use Redirect,Response;
Use DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add_transaksi_form()
    {
        if( \View::exists('transaction.create') ){

            return view('transaction.create');
    
          }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaksi_list()
    {
        $transactions = Transaction::toBase()->get();
        return view('transaction.index',compact('transactions'));
    }


    public function submit_transaksi_data(Request $request)
    {
      $rules = [
          'customer_id' => 'required',
          'container_id' => 'required',
          'tanggal_transaksi' => 'required',
          'tanggal_selesai' => 'required',
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
    //   dd($request->tanggal_transaksi);
      Transaction::create([
         'customer_id' => $request->customer_id,
         'container_id' => $request->container_id,
         'tanggal_transaksi' =>Carbon::createFromFormat('m d Y', $request->tanggal_transaksi)->format('Y-m-d'),
         'tanggal_selesai' => Carbon::createFromFormat('m d Y', $request->tanggal_selesai)->format('Y-m-d'),
         'tujuan' => $request->tujuan,
         'barang' => $request->barang,
         'total' => $request->total,
      ]);

      $this->meesage('message','transaksi created successfully!');
      return redirect()->back();

    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }

   
    
}
