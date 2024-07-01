@extends('admin.layouts.app')

@section('content')
    <div class="container" style="width: 650px;margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"
                         style="text-align: center;font-size: 30px;background-color: #4eb256">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route("web.login")}}">
                            @csrf

                            <br>

                            <div class="row mb-3">
                                <div class="col-md-6" style="width: 350px;margin-left: 25px">
                                    <input id="email" type="email" placeholder="Email Address"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="row mb-3">

                                <div class="col-md-6" style="width: 350px;margin-left: 25px">
                                    <input id="password" type="password" placeholder="Password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"
                                            style="width: 200px;margin-left: -45px;background-color: #4eb256;border: 0 solid ">
                                        {{ __('Login') }}
                                    </button>
                                    <br>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}"
                                           style="margin-left: -30px">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
