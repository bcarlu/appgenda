@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su cuenta de email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nuevo link de verificacion se ha enviado a su cuenta de email') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor ingrese a su correo y acceda al link de verificacion que hemos enviado.') }}
                    {{ __('Si no le ha llegado puede dar') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click aqui para enviarlo nuevamente') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
