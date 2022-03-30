
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
        <h4 class="card-title mb-0">Add Container</h4>
        </div>
        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
          
        <a href="{{ route('container.list') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-list"></span> list Container</a>
        </div>
        </div>
          <br>
          @if(session()->has('message'))
          <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
        @endif
          <form action="{{ route('container.save') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Jenis</label>
                      <input 
                          type="text"
                          name="janis"
                          value="{{ old('janis') }}"
                          placeholder="Jenis Container"
                          class="form-control"
                          required
                      >
                      <font style="color:red"> {{ $errors->has('janis') ?  $errors->first('janis') : '' }} </font>
                  </div>
              </div> 
              <div class="col-12">
                <div class="form-group">
                    <label>Dimensi Internal</label>
                    <textarea class="form-control" 
                        name="dimensi_internal"
                        value="{{ old('dimensi_internal') }}"
                        placeholder="Dimensi Internal example : length : 5,000 mm"
                        class="form-control" rows="3" required></textarea>
                    <font style="color:red"> {{ $errors->has('dimensi_internal') ?  $errors->first('dimensi_internal') : '' }} </font>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Door Opening</label>
                  <textarea class="form-control" 
                        name="door_opening"
                        value="{{ old('door_opening') }}"
                        placeholder="Door Opening example : length : 5,000 mm "
                        class="form-control" rows="3" required></textarea>
                        <font style="color:red"> {{ $errors->has('door_opening') ?  $errors->first('door_opening') : '' }} </font>
                      </div> 
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Weight</label>
                  <textarea class="form-control" 
                        name="weight"
                        value="{{ old('weight') }}"
                        placeholder="weight  example : length : 5,000 mm "
                        class="form-control" rows="3"></textarea>
                        <font style="color:red"> {{ $errors->has('weight') ?  $errors->first('weight') : '' }} </font>
                      </div> 
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label>Status</label>
                  <br>
                  <input type="checkbox" name="status" value="1">
                  <label for="vehicle1">Active</label><br>
                </div> 
              </div>
            
            </div>  

            
            <div class="form-group" style="margin-top: 24px;">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>

          </form>
        
    </div>
</div>
</div>
</div>
@endsection
 