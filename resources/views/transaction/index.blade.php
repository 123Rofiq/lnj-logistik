
@extends('layouts.app')
@php 
              use App\Container;
              use App\Customer;
              @endphp
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
 <style>
 #spinner { visibility:hidden; } 
body.busy .spinner { visibility:visible !important; }
  </style>
@section('content')

<div class="container-fluid">
  <div class="fade-in">
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
      <h4 class="card-title mb-0">List Transaksi</h4>
      </div>
      <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
        
      <a href="{{ route('transaksi.add') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-plus"></span> Add Transaksi</a>
      </div>
      </div>
<br>
     
@if(session()->has('message'))
<p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
@endif
        <div class="row">

        

           <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr class="text-center">
               <th class="text-center">No</th>
               <th class="text-center">Customer</th>
               <th class="text-center">Container</th>
               <th class="text-center">Tanggal Transaki</th>
               <th class="text-center">Tanggal Selesai</th>
               <th class="text-center">Tujuan</th>
                <th class="text-center">Detail Barang</th>
                <th class="text-center">Total</th>
            </tr>
            </thead>
           <tbody>
              @forelse ($transactions as $transaction)
              @php 
                $cus =  Customer::find($transaction->customer_id);
                $cus1 =  Container::find($transaction->container_id);
              @endphp
                <tr class="text-center">
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $cus->name }}</td>
                <td class="text-center">{{ $cus1->janis }}</td>
                <td class="text-center">{{ $transaction->tanggal_transaksi }}</td>
                <td class="text-center">{{ $transaction->tanggal_selesai }}</td>
                <td class="text-center">{{ $transaction->tujuan }}</td>
                <td class="text-center">{{ $transaction->barang }}</td>
                <td class="text-center">{{ $transaction->total }}</td>
               </tr>
              @empty
              <tr>
                <td colspan="5"><p> No Transaksi found!</p></td>
              </tr>
              
              @endforelse
           </tbody>
          </table>
        </div>
    
</div>
</div>
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
      <h4 class="card-title mb-0">Grafik Transaksi</h4>
      </div>
      <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
        

        <a  class="btn btn-info active" onclick="transaksi_status()" > <i class="icon icon-2xl mt-5 mb-2 cil-recycle"></i> Refresh Grafik</a>
      </div>
      </div>
<br>

 
      <div class="chart-container">
        <div class="pie-chart-container">
         
          <canvas id="myChart"></canvas>
        </div>
      </div>  
  </div>
</div>



</div>
</div>
@yield('script')
<script>
  function transaksi_status() {
    $(this).prop("disabled", true);
      // add spinner to button
      $(this).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
      );
    $.ajax({
        type: "GET",
        url: "{{ route('grafik.transaksi.status3') }}",
        success: function (response) {
          console.log(response);
            var labels = response.data.map(function (e) {
                return e.barang
            })

            var data = response.data.map(function (e) {
                return e.jumlah
            })

            var ctx = $('#myChart');
            var config = {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Grafik Customer',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 1)',

                    }]
                }
            };
            var chart = new Chart(ctx, config);
        },
        error: function(xhr) {
            console.log(xhr.responseJSON);
        }
    });
  }
  $(document).ready(function(){
    transaksi_status();
});
</script>



@endsection
 