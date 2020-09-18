@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mt-5">
            <div class="display-4 pb-3 text-dark">
                Appgenda
            </div>
            <div class="h4 alert text-dark" role="alert">Programa tu cita facilmente con nuestra app, no gastes mas tiempo preguntando por fechas y horas disponibles, aquí lo tienes todo. Ingresa si tienes una cuenta o registrate para disfrutar de esta gran utilidad.</div>
            
            <div class="row justify-content-center">
                
            @auth
                <a class="btn text-light font-weight-bold" href="{{ secure_url('/home') }}" style="background: #6c5ce7; border: #6c5ce7">Home</a>
            @else
                <a class=" col-md-5 m-1 btn text-light font-weight-bold" href="{{ route('login') }}" style="background: #6c5ce7; border: #6c5ce7">Ingreso con correo</a>

                <!-- Ingreso con facebook -->
                <a class=" col-md-5 m-1 btn text-light font-weight-bold" href="{{ secure_url('login/facebook') }}" style="background: #0984e3; border: #6c5ce7">Ingreso con facebook</a>
                
                <a class=" col-md-5 m-1 btn text-light font-weight-bold" href="{{ secure_url('login/google') }}" style="background: #d63031; border: #6c5ce7">Ingreso con google</a>
                
                @if (Route::has('register'))
                <a class="col-md-5 m-1 btn text-light font-weight-bold" href="{{ route('register') }}" style="background: #6c5ce7; border: #6c5ce7">Registro</a>
                @endif
            @endauth
                
            </div>
        </div>
    </div>
</div>
@endsection