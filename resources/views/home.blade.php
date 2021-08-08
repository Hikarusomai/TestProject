@extends('layouts.app')

@section('content') 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div> 
      </div> 
    </div> 
    <section class="content">
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$companies ?? 'N/A'}}</h3>

                <p>Companies</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="@if(auth()->user()->type == 'internal'){{route('companies')}}@endif" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$employees ?? 'N/A'}}</h3>

                <p>Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="@if(auth()->user()->type == 'internal'){{route('employees')}}@endif" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  
        </div> 
      </div> 
    </section>  
@endsection
