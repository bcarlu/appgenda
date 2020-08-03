@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mt-5">
            <div class="display-4 pb-3 text-light">
                Appgenda
            </div>
            <div class="h4 alert text-light" role="alert">Programa tu cita facilmente con nuestra app, no gastes mas tiempo preguntando por fechas y horas disponibles, aquí lo tienes todo. Ingresa si tienes una cuenta o registrate para disfrutar de esta gran utilidad.</div>
            
            <div class="row justify-content-center">
                
                    @auth
                <a class="btn text-light font-weight-bold" href="{{ url('/home') }}" style="background-image: linear-gradient(to bottom right, #6c5ce7, #74b9ff); border: #6c5ce7">Home</a>
            @else
                <a class=" col-md-5 m-1 btn text-light font-weight-bold" href="{{ route('login') }}" style="background-image: linear-gradient(to bottom right, #6c5ce7, #74b9ff); border: #6c5ce7">Ingreso</a>

                
               
                
                    @if (Route::has('register'))
                    <a class="col-md-5 m-1 btn text-light font-weight-bold" href="{{ route('register') }}" style="background-image: linear-gradient(to bottom right, #6c5ce7, #74b9ff); border: #6c5ce7">Registro</a>
                @endif
            @endauth
                
            </div>
        </div>
    </div>
</div>
@endsection