
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
      <h4 class="card-title mb-0">List Container</h4>
      </div>
      <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
        
      <a href="{{ route('container.add') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-plus"></span> ADD CONTAINER</a>
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
               <th class="text-center">Dimensi Internal</th>
               <th class="text-center">Door Opening</th>
               <th class="text-center">Weight</th>
               <th class="text-center">Status</th>
               <th class="text-center">Action</th>
            </tr>
            </thead>
           <tbody>
              @forelse ($containers as $container)
                <tr class="text-center">
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $container->janis }}</td>
                <td class="text-center">{{ $container->dimensi_internal }}</td>
                <td class="text-center">{{ $container->door_opening }}</td>
                <td class="text-center">{{ $container->weight }}</td>
                <td class="text-center">{{  ($container->status == 1) ? 'Active' : 'Non Active'  }}</td>
                <td class="text-center">
                  <a href="{{ route('container.edit',$container->id) }}" class="btn btn-sm btn-outline-danger py-0">Edit</a>
                  <a href="{{ route('container.view',$container->id) }}" class="btn btn-sm btn-outline-danger py-0">View</a>
                  <a href="" onclick="if(confirm('Do you want to delete this container?'))event.preventDefault(); document.getElementById('delete-{{$container->id}}').submit();" class="btn btn-sm btn-outline-danger py-0">Delete</a>
                  <form id="delete-{{$container->id}}" method="post" action="{{route('container.delete',$container->id)}}" style="display: none;">
                  @csrf
                  @method('DELETE')
                </form>
                </td>
               </tr>
              @empty
              <tr>
                <td colspan="5"><p> No container found!</p></td>
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
      <h4 class="card-title mb-0">Grafik Container</h4>
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
        url: "{{ route('grafik.transaksi.status2') }}",
        success: function (response) {
          console.log(response);
            var labels = response.data.map(function (e) {
                return e.janis
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
                        label: 'Grafik Container',
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
 