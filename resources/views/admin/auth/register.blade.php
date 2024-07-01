@extends('admin.layouts.app')

@section('content')
    <div class="container" style="width: 650px;margin-top: 40px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"
                         style="text-align: center;font-size: 30px;background-color: #4eb256">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route("web.register")}}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6" style="width: 350px;margin-left: 25px">
                                    <input id="name" type="text" placeholder="Full Name"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6" style="width: 350px;margin-left: 25px">
                                    <input id="email" type="email" placeholder="Email Address"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6" style="width: 350px;margin-left: 25px">
                                    <input id="password" type="password" placeholder="Password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6" style="width: 350px;margin-left: 25px">
                                    <input id="password-confirm" type="password" placeholder="Confirm Password"
                                           class="form-control" name="password_confirmation" required
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"
                                            style="width: 200px;margin-left: -45px;background-color: #4eb256;border: 0 solid ">
                                        {{ __('Register') }}
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
