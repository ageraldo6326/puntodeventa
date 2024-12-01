@extends('layout.main')

@section('title', 'Register')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>        
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>        
        @endif
        <h2 class="text-center">Registrarse</h2>
        <form action="{{ route('registerPost') }}" method="POST">
            @csrf
          <div class="form-group mb-3">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
          </div>
          <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
          </div>
          <div class="form-group mb-3">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu nombre" required>
          </div>      
          <button type="submit" class="btn btn-primary w-100">Registrar</button>
          <div class="text-center mt-3">
            <a href="{{ route('login') }}">Ir a login</a>
          </div>
        </form>
  </div>
  </div>
</div>

@endsection