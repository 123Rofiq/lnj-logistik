
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
          <h4 class="card-title mb-0">View Data Customer</h4>
          </div>
          <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            
          <a href="{{ route('customer.list') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-list"></span> list CUSTOMER</a>
          </div>
          </div>
            <br>
        <div >
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" readonly class="form-control" name="name" value="{{ $customer->name}}">
                <font style="color:red"> {{ $errors->has('name') ?  $errors->first('name') : '' }} </font>
              </div>
  
         
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" readonly class="form-control" name="email" value="{{ $customer->email }}">
              <font style="color:red"> {{ $errors->has('email') ?  $errors->first('email') : '' }} </font>
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <textarea class="form-control" 
                          name="alamat"
                          rows="3" readonly> {{ $customer->alamat }}</textarea>
                <font style="color:red"> {{ $errors->has('alamat') ?  $errors->first('alamat') : '' }} </font>
              </div>
            <div class="form-group" style="margin-top: 24px;">
              <a href="{{ route('customer.list') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
 