
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
        <h4 class="card-title mb-0">Edit Data Customer</h4>
        </div>
        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
          
        <a href="{{ route('customer.list') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-list"></span> list CUSTOMER</a>
        </div>
        </div>
          <br>

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif

         

          <form action="{{ route('customer.update',$customer->slug) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $customer->name}}">
              <font style="color:red"> {{ $errors->has('name') ?  $errors->first('name') : '' }} </font>
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="email" class="form-control" name="email" value="{{ $customer->email }}">
              <font style="color:red"> {{ $errors->has('email') ?  $errors->first('email') : '' }} </font>
            </div>
            <div class="form-group">
              <label for="">Address</label>
              <textarea class="form-control" 
                        name="alamat"
                        rows="3"> {{ $customer->alamat }}</textarea>
              <font style="color:red"> {{ $errors->has('alamat') ?  $errors->first('alamat') : '' }} </font>
            </div>
            
            <div class="form-group" style="margin-top: 24px;">
              <input type="submit" class="btn btn-info" value="Update">
            </div>

          </form>
        </div>
    </div>
</div>
</div>
@endsection
 