
@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="fade-in">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
          <h4 class="card-title mb-0">View Data Container</h4>
          </div>
          <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            
          <a href="{{ route('container.list') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-list"></span> list container</a>
          </div>
          </div>
            <br>
        <div >
          <div class="form-group">
            <label for="">Jenis</label>
            <input type="text" class="form-control" name="janis" readonly value="{{ $container->janis}}">
            <font style="color:red"> {{ $errors->has('janis') ?  $errors->first('janis') : '' }} </font>
          </div>
          
          <div class="form-group">
            <label>Dimensi Internal</label>
            <textarea class="form-control" 
                name="dimensi_internal"
                value="{{ old('dimensi_internal') }}"
                placeholder="Dimensi Internal example : length : 5,000 mm"
                class="form-control" rows="3" readonly>{{ $container->dimensi_internal}}</textarea>
              <font style="color:red"> {{ $errors->has('dimensi_internal') ?  $errors->first('dimensi_internal') : '' }} </font>
          </div>

          <div class="form-group">
            <label>Door Opening</label>
            <textarea class="form-control" 
                  name="door_opening"
                  value="{{ old('door_opening') }}"
                  placeholder="Door Opening example : length : 5,000 mm "
                  class="form-control" rows="3" readonly>{{ $container->door_opening}}</textarea>
                  <font style="color:red"> {{ $errors->has('door_opening') ?  $errors->first('door_opening') : '' }} </font>
                </div> 

                <div class="form-group">
                  <label>Weight</label>
                  <textarea class="form-control" 
                        name="weight"
                        value="{{ old('weight') }}"
                        placeholder="weight  example : length : 5,000 mm "
                        class="form-control" rows="3" readonly>{{ $container->weight}}</textarea>
                        <font style="color:red"> {{ $errors->has('weight') ?  $errors->first('weight') : '' }} </font>
                      </div> 

                      <div class="form-group">
                        <label>Status</label>
                        <br>
                        <label for="vehicle1"> {{($container->status == 1) ? 'Active ' : 'Non Active'}}</label><br>
                      </div> 
            <div class="form-group" style="margin-top: 24px;">
              <a href="{{ route('container.list') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
 