@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8 text-center mt-5">
        <div class="display-4 pb-3">
            Appgenda
        </div>
        <div class="h4 alert alert-secondary" role="alert">Programa tu cita facilmente con nuestra app, no gastes mas tiempo preguntando por fechas y horas disponibles, aquí lo tienes todo. Ingresa si tienes una cuenta o registrate para disfrutar de esta gran utilidad.</div>


        <div class="links">
           @auth
                <a class="btn btn-primary" href="{{ url('/home') }}">Home</a>
            @else
                <a class="btn btn-primary" href="{{ route('login') }}">Ingreso</a>

                @if (Route::has('register'))
                    <a class="btn btn-primary" href="{{ route('register') }}">Registro</a>
                @endif
            @endauth
        </div>
    </div>
</div>
</div>
@endsection