{{-- @extends('layouts.app') --}}
@extends('layouts.html_head')
@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-TLP-O">
                <div class="card-header"><h2>Dresseur, inscris-toi!</h2>{{-- {{ __('Register') }} --}}</div>

                <div class="card-body">
                    <form method="POST" class="connect_or_login_form" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Votre nom:{{-- {{ __('Name') }} --}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Votre adresse e-mail:{{-- {{ __('E-Mail Address') }} --}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

{{--                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong><p style='padding: 1rem;'>Erreur : L'adresse e-mail renseignée est déja associée à un compte.{{-- {{ $message }} --}}<p></strong>
                                    {{-- </span> --}}
                                {{-- @enderror --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe:{{-- {{ __('Password') }} --}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

{{--                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong><p style='padding: 1rem;'>Erreur : Votre mot de passe doit contenir un minimum de 8 carractères.{{-- {{ $message }} --}}<p></strong>
{{--                                     </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmez votre mot de passe:{{-- {{ __('Confirm Password') }} --}}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-check">
                                <input type="hidden" name="is_admin" value="0" /> <!-- Dans l'eventualité où la checkbox n'est pas cochée -->
                                <input id="admin-confirm" type="checkbox" class="form-check-input" {{-- class="form-control" --}} name="is_admin" value="1" data-val="1">
                                <label for="admin" class="form-check-label" class="col-md-4 col-form-label text-md-right" style="vertical-align: 2;">Devenir administrateur</label>
                            </div>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong><p style='padding: 1rem;'>Erreur : L'adresse e-mail renseignée est déja associée à un compte.{{-- {{ $message }} --}}<p></strong>
                        </span>
                        @enderror

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong><p style='padding: 1rem;'>Erreur : Votre mot de passe doit contenir un minimum de 8 carractères ou bien la confirmation de celui ci a échoué.{{-- {{ $message }} --}}<p></strong>
                        </span>
                        @enderror



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 TLP-O-Submit-thing">
                                <button type="submit" class="btn btn-primary">
                                    M'inscrire{{-- {{ __('Register') }} --}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
