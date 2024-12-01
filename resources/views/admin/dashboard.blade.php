@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">

<div class="row">

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $customers }}</h3>

        <p>Clientes</p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $providers }}<sup style="font-size: 20px"></sup></h3>

        <p>Proveedores</p>
      </div>
      <div class="icon">
        <i class="fas fas fa-truck"></i>
      </div>
    </div>
  </div>

    <!-- ./col -->

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner text-white">
        <h3>{{ $products }}</h3>

        <p>Productos</p>
      </div>
      <div class="icon">
        <i class="fas fa-tags"></i>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $categories }}</h3>

        <p>Categorias</p>
      </div>
      <div class="icon">
        <i class="fas fa-list"></i>
      </div>
    </div>
  </div>

  <!-- ./col -->


    <!-- ./col -->



  
</div>

<div class="row">

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>{{ $invoices }}</h3>

        <p>Facturas</p>
      </div>
      <div class="icon">
        <i class="fas fa-file-invoice"></i>
      </div>
    </div>
  </div>


  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>{{ $purchases }}</h3>

        <p>Compras</p>
      </div>
      <div class="icon">
        <i class="fas fa-shopping-cart"></i>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box" style="background-color: #4f40d6">
      <div class="inner text-white">
        <h3 >{{ number_format($totalsale, 2) }}</h3>

        <p >Importe Vendido</p>
      </div>
      <div class="icon">
        <i class="fas fa-file-invoice-dollar"></i>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box" style="background-color: #ff59c8">
      <div class="inner text-white">
        <h3 >{{ number_format($totalpurchase, 2) }}</h3>

        <p >Importe Comprado</p>
      </div>
      <div class="icon">
        <i class="fas fa-shopping-cart"></i>
      </div>
    </div>
  </div>

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box" style="background-color: #00c0ef">
        <div class="inner text-white">
          <h3 >{{ $users }}</h3>

          <p >Usuarios</p>
        </div>
        <div class="icon">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </div>



    <!-- ./col -->




    <!-- ./col -->
    {{-- <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $providers }}<sup style="font-size: 20px"></sup></h3>

          <p>Proveedores</p>
        </div>
        <div class="icon">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $products }}</h3>

          <p>Productos</p>
        </div>
        <div class="icon">
          <i class="fas fa-dolly"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $customers }}</h3>

          <p>Clientes</p>
        </div>
        <div class="icon">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </div> --}}
    <!-- ./col -->
</div>

<div class="row">


</div>

</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop