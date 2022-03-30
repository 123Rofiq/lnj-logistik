
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
        <h4 class="card-title mb-0">Add Customer</h4>
        </div>
        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
          
        <a href="{{ route('customer.list') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-list"></span> list CUSTOMER</a>
        </div>
        </div>
          <br>
          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif
          <form action="{{ route('customer.save') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label>Name customer</label>
                      <input 
                          type="text"
                          name="name"
                          value="{{ old('name') }}"
                          placeholder="Form name"
                          class="form-control"
                          required
                      >
                      <font style="color:red"> {{ $errors->has('name') ?  $errors->first('name') : '' }} </font>
                  </div>
              </div> 
              <div class="col-6">
                <div class="form-group">
                    <label>Email</label>
                    <input 
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        class="form-control"
                        required
                    >
                    <font style="color:red"> {{ $errors->has('email') ?  $errors->first('email') : '' }} </font>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Email</label>
                  <textarea class="form-control" 
                        name="alamat"
                        value="{{ old('alamat') }}"
                        placeholder="Alamat Customer"
                        class="form-control" rows="3"></textarea>
                        <font style="color:red"> {{ $errors->has('alamat') ?  $errors->first('alamat') : '' }} </font>
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
 