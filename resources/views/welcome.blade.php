@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mt-5">
            <div class="display-4 pb-3 text-light">
                Appgenda
            </div>
            <div class="h4 alert text-light" role="alert">Programa tu cita facilmente con nuestra app, no gastes mas tiempo preguntando por fechas y horas disponibles, aquí lo tienes todo. Ingresa si tienes una cuenta o registrate para disfrutar de esta gran utilidad.</div>
            
            @auth
                <a class="btn btn-outline-secondary font-weight-bold" href="{{ url('/home') }}">Home</a>
            @else
                <a class="btn btn-outline-secondary font-weight-bold" href="{{ route('login') }}">Ingreso</a>

                @if (Route::has('register'))
                    <a class="btn btn-outline-secondary font-weight-bold" href="{{ route('register') }}">Registro</a>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection