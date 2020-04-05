{{-- @extends('layouts.app') --}}
@extends('layouts.html_head')
@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-TLP-O">
                <div class="card-header"><h2>Connectes-toi !</h2>{{-- {{ __('Login') }} --}}</div>

                <div class="card-body">
                    <form method="POST" class='connect_or_login_form' action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Votre adresse e-mail:{{-- {{ __('E-Mail Address') }} --}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe:{{-- {{ __('Password') }} --}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <br><br style='line-height:0.5rem'>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Erreur : Ce mot de passe semble invalide.{{-- {{ $message }} --}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style='vertical-align: 2;'>
                                        Se souvenir de moi{{-- {{ __('Remember Me') }} --}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong><p style='padding: 1rem;'>Erreur : L'adresse e-mail renseignée ou le mot de passe sont érronés.{{-- {{ $message }} --}}<p></strong>
                            </span>
                        @enderror

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 TLP-O-Submit-thing">
                                <button type="submit" class="btn btn-primary">
                                    Se connecter
                                    {{-- {{ __('Login') }} --}}
                                </button>

{{--                                 @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Mot de passe oublié ?
                                         {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
