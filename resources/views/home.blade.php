@extends('layouts.app')
<style>
  table#laravel_crud tr td { font-size: 13px; }
</style>
<head>

  </head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 

{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> --}}
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="card-title mb-0">Tabel</h4>
              </div>
              
              </div>

              <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12 text-right">
                                    <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post" onclick="addPost()">Add Post</a>
                </div>
             </div>

             @if(session()->has('message'))
             <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
           @endif
             <div class="row">
                 <div class="col-12">
                  <table id="laravel_crud" class="table-responsive table table-striped table-responsive table-bordered">
                    <thead>
                        <tr style="font-size: 12px;">
                            <th>No</th>
                            <th>Create Date</th>
                            <th>Carp Code</th>
                            <th>Category</th>
                            <th>Initiator <br> Initiator Div <br> Initiator Branch </th>
                            <th>Recipient <br> Recipient Div <br> Recipient Branch </th>
                            <th>Verified By</th>
                            <th>Due Date</th>
                            <th>Effectiveness</th>
                            <th>Stage</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach($posts as $post)
                        <tr id="row_{{$post->id}}"  style="font-size: 10px;">
                           <td>{{ $loop->index + 1 }}</td>
                           <td> {{ date('d-M-Y', strtotime($post->date_create)) }} </td>
                           <td>{{ $post->carp_code }}</td>
                           <td>{{ $post->category }}</td>
                           <td>{{ $post->initiator }} <br>{{ $post->initiator_div}}  <br>{{ $post->initiator_branch}}  </td>
                           <td>{{ $post->recipient }} <br>{{ $post->recipient_div}}  <br>{{ $post->recipient_branch}}</td>
                           <td>{{ $post->verified_by }}</td>
                           <td> {{ date('d-M-Y', strtotime($post->due_date)) }} </td>
                           <td>{{ $post->effectiveness }}</td>
                           <td>{{ $post->stage }}</td>
                           <td>{{ $post->status }}</td>
                           <td class="text-center">
                             <div class="form-group">
                             <a href="javascript:void(0)" data-id="{{ $post->id }}" onclick="viewPost(event.target)" class="btn btn-info">View</a>
                          <br>
                             <a href="javascript:void(0)" data-id="{{ $post->id }}" onclick="editPost(event.target)" class="btn btn-success">Edit</a>
                             <br>
                            <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a></td>
                             </div>
                           </tr>
                        @endforeach
                    </tbody>
                  </table>
               
                </div>
             </div>

          </div>
        </div>
      </div>

      
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="card-title mb-0">Grafik Status</h4>
              </div>
              {{-- <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">        
                <a  class="btn btn-info active" onclick="transaksi_status()" > <i class="icon icon-2xl mt-5 mb-2 cil-recycle"></i> Refresh Grafik</a>
              </div> --}}
              </div>
              <div id="pie_chart" style="width:450px; height:250px;">
              </div>

          </div>
        </div>        
      </div>
      <div class="col-md-6">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="card-title mb-0">Stage</h4>
              </div>
              
              </div>
              <br>
              <div class="row">
              @forelse ($stage as $value)
              @php 
                if($value->stage == 'Closed'){
                  $color = "aqua";
                }elseif ($value->stage == 'Open') {
                  $color = "#4863A0";
                }elseif ($value->stage == 'Responded') {
                  $color = "#151B54";
                }elseif ($value->stage == 'Closed') {
                  $color = "red";
                }elseif ($value->stage == 'Re-Open') {
                  $color = "#808000";
                }elseif ($value->stage == 'Verified') {
                  $color = "#3EA055";
                }elseif ($value->stage == 'Voided') {
                  $color = "gray";
                }else {
                  $color = "blue";
                }
              @endphp
              <div class="col-sm-4 col-lg-4">
                 <div class="card">
                <div class="card-header" style="background-color:{{  $color }} "> 
                  <h5 class="card-title" style="color: white" >{{ $value->stage }}</h5>
                 
                </div>
                <div class="card-body" style="background-color: white">
                  {{ $value->count }}
                </div>

              </div>
            </div>

            @empty
<p>No container found!</p>
            
            @endforelse
          </div>
              

         

      </div>

    </div>
</div>
</div>

<div class="modal fade" id="post-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <form name="userForm" class="form-horizontal">
               <input type="hidden" name="post_id" id="post_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2">Carp Code</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" readonly id="Carp Code" value="Generate" name="carp_code" placeholder="Enter title">
                    </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2">Category</label>
                  <div class="col-sm-12">
                      <select name="category" id="category" class="form-control">
                        <option value=""> .: Select :.</option>
                        <option value="internal audit findings, non conformity">internal audit findings, non conformity</option>
                        <option value="non conformity">non conformity</option>
                        <option value="oportunity for improvement">oportunity for improvement</option>
                        <option value="non conformity, external complain">	non conformity, external complain</option>
                      </select>
                      <span id="titleError" class="alert-message"></span>
                  </div>
              </div>
            
            <div class="form-group">
                <label for="name" class="col-sm-2">Initiator</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="initiator" name="initiator" placeholder="Enter title">
                    <span id="titleError" class="alert-message"></span>
                </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2">Initiator Div</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="initiator_div" name="initiator_div" placeholder="Enter title">
                  <span id="titleError" class="alert-message"></span>
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2">Initiator Branch</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="initiator_branch" name="initiator_branch" placeholder="Enter title">
                  <span id="titleError" class="alert-message"></span>
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2">Recipient</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="recipient" name="recipient" placeholder="Enter title">
                  <span id="titleError" class="alert-message"></span>
              </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2">Rcipient Div</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="recipient_div" name="recipient_div" placeholder="Enter title">
                <span id="titleError" class="alert-message"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2">Recipient Branch</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="recipient_branch" name="recipient_branch" placeholder="Enter title">
                <span id="titleError" class="alert-message"></span>
            </div>
          </div>

          


              
            </form>
        </div>
        <div class="modal-footer">
            <button id="save-btn" type="button" class="btn btn-primary" onclick="createPost()">Save</button>
        </div>
    </div>
  </div>



</div>

@yield('script')
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script>

  $('#laravel_crud').DataTable( {
    responsive: true
} );


  function addPost() {
    $(".modal-title").text('Add Data');

    $("#post_id").val('');
$('#post-modal').modal('show');
  }

  function viewPost(event) {
    $(".modal-title").text('View Data');
    var id  = $(event).data("id");
    let _url = `/home/${id}`;
    $('#titleError').text('');
    $('#descriptionError').text('');
    
    $.ajax({
      url: _url,
      type: "GET",
      success: function(response) {
          if(response) {
            $("#post_id").val(response.id);
            $("#carp_code").val(response.carp_code);
            $("#category").attr('readonly', true);
            $("#category").val(response.category);
            $("#initiator").val(response.initiator);
            $("#initiator").attr('readonly', true);
            $("#initiator_div").val(response.initiator_div);
            $("#initiator_div").attr('readonly', true);
            $("#initiator_branch").val(response.initiator_branch);
            $("#initiator_branch").attr('readonly', true);
            $("#recipient").val(response.recipient);
            $("#recipient").attr('readonly', true);
            $("#recipient_div").val(response.recipient_div);
            $("#recipient_div").attr('readonly', true);
            $("#recipient_branch").val(response.recipient_branch);
            $("#recipient_branch").attr('readonly', true);
            $("#save-btn").hide();
            $('#post-modal').modal('show');
          }
      }
    });
  }

  function editPost(event) {
    $(".modal-title").text('Edit Data');
    var id  = $(event).data("id");
    let _url = `/home/${id}`;
    $('#titleError').text('');
    $('#descriptionError').text('');
    
    $.ajax({
      url: _url,
      type: "GET",
      success: function(response) {
          if(response) {
            $("#post_id").val(response.id);
            $("#carp_code").val(response.carp_code);
            $("#category").val(response.category);
            $("#initiator").val(response.initiator);
            $("#initiator_div").val(response.initiator_div);
            $("#initiator_branch").val(response.initiator_branch);
            $("#recipient").val(response.recipient);
            $("#recipient_div").val(response.recipient_div);
            $("#recipient_branch").val(response.recipient_branch);

            $('#post-modal').modal('show');
          }
      }
    });
  }
  
  function createPost() {
    
    var carp_code = $('#carp_code').val();
    var category = $('#category').val();
    var initiator = $('#initiator').val();
    var initiator_div = $('#initiator_div').val();
    var initiator_branch = $('#initiator_branch').val();
    var recipient = $('#recipient').val();
    var recipient_div = $('#recipient_div').val();
    var recipient_branch = $('#recipient_branch').val();

    var id = $('#post_id').val();

    // let _url     = '/home/save';
    // let _token   = $('meta[name="csrf-token"]').attr('content');
  //  console.log(_token);
 
      $.ajax({
        url: "/home",
        type: "POST",
        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
        // dataType:'json',
        data: {
          id: id,
          carp_code: carp_code,
          category: category,
          initiator: initiator,
          initiator_div: initiator_div,
          initiator_branch: initiator_branch,
          recipient: recipient,
          recipient_div: recipient_div,
          recipient_branch: recipient_branch
        },
        success: function(response) {
          console.log(response.data);
            if(response.code == 200) {
              if(id != ""){
                $("#row_"+id+" td:nth-child(2)").html(response.data.date_create);
                $("#row_"+id+" td:nth-child(3)").html(response.data.carp_code);
                $("#row_"+id+" td:nth-child(4)").html(response.data.category);
                $("#row_"+id+" td:nth-child(5)").html(response.data.initiator);
                $("#row_"+id+" td:nth-child(6)").html(response.data.initiator_div);
                $("#row_"+id+" td:nth-child(7)").html(response.data.initiator_branch);
                $("#row_"+id+" td:nth-child(8)").html(response.data.recipient);
                $("#row_"+id+" td:nth-child(9)").html(response.data.recipient_div);
                $("#row_"+id+" td:nth-child(10)").html(response.data.recipient_branch);
                $("#row_"+id+" td:nth-child(11)").html(response.data.verified_by);
                $("#row_"+id+" td:nth-child(12)").html(response.data.effectiveness);
                $("#row_"+id+" td:nth-child(13)").html(response.data.status_date);
                $("#row_"+id+" td:nth-child(14)").html(response.data.stage);
                $("#row_"+id+" td:nth-child(16)").html(response.data.status_date);
              } else {
                $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.date_create+'</td><td>'+response.data.carp_code+'</td><td>'+response.data.category+'</td><td>'+response.data.initiator+'</td><td>'+response.data.initiator_div+'</td><td>'+response.data.initiator_branch+'</td><td>'+response.data.recipient+'</td><td>'+response.data.recipient_div+'</td><td>'+response.data.recipient_branch+'</td><td>'+response.data.verified_by+'</td><td>'+response.data.due_date+'</td><td>'+response.data.effectiveness+'</td><td>'+response.data.status_date+'</td><td>'+response.data.stage+'</td><td>'+response.data.status+'</td><td>  <a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="viewPost(event.target)" class="btn btn-info">View</a> <br> <a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editPost(event.target)" class="btn btn-success">Edit</a><br><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a></td></tr>');
              }
              $("#pesan").html(response.message);
              $('#title').val('');
              $('#description').val('');

              $('#post-modal').modal('hide');
              transaksi_status();
            }
        },
        error: function(response) {
          // $('#titleError').text(response.responseJSON.errors.title);
          // $('#descriptionError').text(response.responseJSON.errors.description);
        }
      });
  }

  function deletePost(event) {
    var id  = $(event).data("id");
    let _url = `/home/${id}`;
  
      $.ajax({
        url: _url,
        type: 'DELETE',
        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
        // data: {
        //   _token: _token
        // },
        success: function(response) {
          $("#row_"+id).remove();
          console.log('response', response);

        }
      });
  }


function transaksi_status(){
  var students =  <?php echo json_encode($data); ?>;
     var options = {
         chart: {
             renderTo: 'pie_chart',
             // plotBackgroundColor: null,
             // plotBorderWidth: null,
             // plotShadow: false
         },
         title: {
             text: 'Total'
         },
       
          tooltip: {

     formatter: function () {
         return '</b>'+this.point.name +" : "+ this.y + '</b>';
     }
   },
         plotOptions: {
             pie: {
                 allowPointSelect: false,
                 
                 cursor: 'pointer',
                     dataLabels: {
                     enabled: false,
                     color: '#000000',
                     connectorColor: '#000000',
                     // formatter: function() {
                     //     return '<b>'+ this.point.name +'</b>: '+ this.percentage +' ';
                     // }
                 }
             }
         },
         series: [{
             type:'pie',
             showInLegend:true,
             innerSize: '50%',
            
         }]
     }
     myarray = [];
     $.each(students, function(index, val) {
         myarray[index] = [val.status, val.count];
     });
     options.series[0].data = myarray;
     chart = new Highcharts.Chart(options);
}


$(document).ready(function() {
  transaksi_status();

     
 });

</script>




@endsection