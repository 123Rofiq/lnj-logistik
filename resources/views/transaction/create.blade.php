
@extends('layouts.app')
@php 
use App\Container;
use App\Customer;
 $items = Customer::pluck('name', 'id');

$selectedID = 0;

$items_container = Container::pluck('janis', 'id');

$selected_container = 0;
@endphp

@section('content')
<div class="container-fluid">
  <div class="fade-in">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <div>
        <h4 class="card-title mb-0">Add Transaksi</h4>
        </div>
        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
          
        <a href="{{ route('transaksi.list') }}" style="background-color: green;color:white" class="btn  active" > <span class="fa fa-list"></span> list Transaksi</a>
        </div>
        </div>
          <br>
          @if(session()->has('message'))
          <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
        @endif
          <form action="{{ route('transaksi.save') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                <label>Customer</label>
                <select class="form-control" name="customer_id">
                  <option>Select Customer</option>
                  @foreach ($items as $key => $value)
                      <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                          {{ $value }} 
                      </option>
                  @endforeach    
              </select>
                </div>
             
                      <font style="color:red"> {{ $errors->has('janis') ?  $errors->first('janis') : '' }} </font>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                    <label>Container</label>
                    <select class="form-control" name="container_id">
                      <option>Select Container</option>
                      @foreach ($items_container as $key => $value)
                          <option value="{{ $key }}" {{ ( $key == $selected_container) ? 'selected' : '' }}> 
                              {{ $value }} 
                          </option>
                      @endforeach    
                  </select>
                    </div>
                 
                          <font style="color:red"> {{ $errors->has('janis') ?  $errors->first('janis') : '' }} </font>
                      </div>
              
              <div class="col-6">
                <div class="form-group">
                  <label>Tanggal Transaksi</label>
                    <input type="text" class="form-control datetimepicker" name="tanggal_transaksi"> 
                  
              </div>
               
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Tanggal Selesai</label>
                    <input type="text" class="form-control datetimepicker" name="tanggal_selesai"> 
                  
              </div>
               
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Tujuan</label>
                  <textarea class="form-control" 
                        name="tujuan"
                        value="{{ old('tujuan') }}"
                        placeholder="Tujuan"
                        class="form-control" rows="3" required></textarea>
                        <font style="color:red"> {{ $errors->has('tujuan') ?  $errors->first('tujuan') : '' }} </font>
                      </div> 
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Detail Barang</label>
                  <textarea class="form-control" 
                        name="barang"
                        value="{{ old('barang') }}"
                        placeholder="detail barang"
                        class="form-control" rows="3"></textarea>
                        <font style="color:red"> {{ $errors->has('barang') ?  $errors->first('barang') : '' }} </font>
                      </div> 
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label>Total</label>
                  <br>
                  <input type="text" class="form-control datetimepicker" name="total"> 
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