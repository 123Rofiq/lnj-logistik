<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'container_id',
        'tanggal_transaksi',
        'tanggal_selesai',
        'tujuan',
        'barang',
        'total'
       ];
   
}
