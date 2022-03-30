
@extends('layouts.app')
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
      <h4 class="card-title mb-0">List Customer</h4>
      </div>
      <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
        
      <a href="{{ route('customer.add') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-plus"></span> ADD CUSTOMER</a>
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
               <th class="text-center">Name</th>
               <th class="text-center">Address</th>
               <th class="text-center">Email</th>
               <th class="text-center">Action</th>
            </tr>
            </thead>
           <tbody>
              @forelse ($customers as $customer)
                <tr class="text-center">
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $customer->name }}</td>
                <td class="text-center">{{ $customer->alamat }}</td>
                <td class="text-center">{{ $customer->email }}</td>
                <td class="text-center">
                  <a href="{{ route('customer.edit',$customer->slug) }}" class="btn btn-sm btn-outline-danger py-0">Edit</a>
                  <a href="{{ route('customer.view',$customer->slug) }}" class="btn btn-sm btn-outline-danger py-0">View</a>
                  <a href="" onclick="if(confirm('Do you want to delete this customer?'))event.preventDefault(); document.getElementById('delete-{{$customer->slug}}').submit();" class="btn btn-sm btn-outline-danger py-0">Delete</a>
                  <form id="delete-{{$customer->slug}}" method="post" action="{{route('customer.delete',$customer->slug)}}" style="display: none;">
                  @csrf
                  @method('DELETE')
                </form>
                </td>
               </tr>
              @empty
              <tr>
                <td colspan="5"><p> No customer found!</p></td>
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
      <h4 class="card-title mb-0">Grafik Customer</h4>
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
        url: "{{ route('grafik.transaksi.status') }}",
        success: function (response) {
          console.log(response);
            var labels = response.data.map(function (e) {
                return e.name
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
 