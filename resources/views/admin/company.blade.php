@extends('adminlte::page')

@section('title', 'Compañia')

@section('content_header')
    <h1>Compañia</h1>
@stop

@section('content')
    @livewire('company')
@stop

@section('css')

@stop

@section('js')

    <script>

        document.addEventListener('updateCompanySweetalert', () => {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Compañia Actualizada Exitosamente",
                showConfirmButton: false,
                timer: 1500
            });
        })


    </script>
@stop