@extends('layouts.app')

@section('content')
<div class="container-fluid background_form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card_title">
                <div class="card-header card_head">{{ __('Reset Password') }}</div>

                <div class="card-body form_log">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row pb-2">
                            <label for="email" class="col-md-6 col-form-label text-md-right title_input">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 input_value">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label for="password" class="col-md-6 col-form-label text-md-right title_input">{{ __('Password') }}</label>

                            <div class="col-md-6 input_value">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label for="password-confirm" class="col-md-6 col-form-label text-md-right title_input">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6 input_value">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn button_reg">
                                    {{ __('Reset Password') }}
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
