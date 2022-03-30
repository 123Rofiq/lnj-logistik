@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

@section('content')
<div class="container-fluid">
  <div class="fade-in">
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <h4 class="card-title mb-0">Data User</h4>
        <div class="small text-muted"> <?= date('M Y') ?> </div>
      </div>
      <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
        

        <a  class="btn btn-info active" onclick="transaksi_status()" > <i class="icon icon-2xl mt-5 mb-2 cil-recycle"></i> Refresh Grafik</a>
      </div>
      </div>
  
      <div class="chart-container">
        <div class="pie-chart-container">
          <canvas id="pie-chart"></canvas>
        </div>
      </div>  
  </div>
</div>
</div>
</div>
 
@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection

@yield('script')


<script>
     function transaksi_status() {
    $(this).prop("disabled", true);
      // add spinner to button
      $(this).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
      );
     //get the pie chart canvas
     var cData = JSON.parse(`<?php echo $chart_data; ?>`);
     var ctx = $("#pie-chart");

     //pie chart data
     var data = {
       labels: cData.label,
       datasets: [
         {
           label: "Users Count",
           data: cData.data,
           backgroundColor: [
             "#DEB887",
             "#A9A9A9",
             "#DC143C",
             "#F4A460",
             "#2E8B57",
             "#1D7A46",
             "#CDA776",
           ],
           borderColor: [
             "#CDA776",
             "#989898",
             "#CB252B",
             "#E39371",
             "#1D7A46",
             "#F4A460",
             "#CDA776",
           ],
           borderWidth: [1, 1, 1, 1, 1,1,1]
         }
       ]
     };

     //options
     var options = {
       responsive: true,
       title: {
         display: true,
         position: "top",
         text: "Last Week Registered Users -  Day Wise Count",
         fontSize: 18,
         fontColor: "#111"
       },
       legend: {
         display: true,
         position: "bottom",
         labels: {
           fontColor: "#333",
           fontSize: 16
         }
       }
     };

     //create Pie Chart class object
     var chart1 = new Chart(ctx, {
       type: "bar",
       data: data,
       options: options
     });

    }
 $(document).ready(function(){
    transaksi_status();
});
</script>

@endsection