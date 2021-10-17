@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-def">
                <div class="card-header bag-primary">Login</div>

                <div class="card-body">
                    <div class="text-center">
                        <img src="/assets/img/ic_logo_grup.png" class="img-fluid mb-3" style="max-width: 30%;">
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @if (Route::has('password.request'))
                        <div class="text-center">
                        <a class="btn btn-link " href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                        @endif                   
                        </div>     

                        <div class="form-group row mb-2">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>                                
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-12 text-center">
                                Atau Login dengan                               
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-12 text-center">
                                <a href="{{ url('/auth/google') }}" class="btn btn-primary"><i class="fa fa-google"></i> Google</a>
                            </div>
                        </div>   

                        <div class="text-center mb-2">
                            Belum Punya Akun? <a href="/register">Daftar</a>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
