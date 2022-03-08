@extends('layouts.app')

@section('navbar')
@include('partials.adv')
@endsection

@section('content')
    <div class="container-fluid background_form_reg">
        <div class="row justify-content-center">
            <div class="form d-flex justify-content-center align-items-center">
                <div class="card card_title">
                    <div class="card-header card_head">{{ __('Register') }}</div>

                    <div class="card-body form_log px-0">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf



                            <div class="form-group row card_padding pb-2">
                                <label for="email" class="col-md-6 col-form-label text-md-right title_input">
                                    <p class="rule">I campi con l'asterisco sono obbligatori.</p>
                                    <span class="symbol">*</span>
                                    {{ __('E-Mail Address') }}
                                </label>

                                <div class="col-md-6 input_value">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row card_padding pb-2">
                                <label for="password" class="col-md-6 col-form-label text-md-right title_input">
                                    <span class="symbol">*</span>
                                    {{ __('Password') }}</label>

                                <div class="col-md-6 input_value">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" minlength="8">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row card_padding pb-2">
                                <label for="password-confirm" class="col-md-6 col-form-label text-md-right title_input">
                                    <span class="symbol">*</span>
                                    {{ __('Confirm Password') }}</label>

                                <div class="col-md-6 input_value">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row card_padding pb-2">
                                <label for="name"
                                    class="col-md-6 col-form-label text-md-right title_input">{{ __('Name') }}</label>

                                <div class="col-md-6 input_value">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row card_padding pb-2">
                                <label for="lastname"
                                    class="col-md-6 col-form-label text-md-right title_input">{{ __('Lastname') }}</label>

                                <div class="col-md-6 input_value">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row card_padding pb-2">
                                <label for="date_of_birth"
                                    class="col-md-6 col-form-label text-md-right title_input">{{ __('Date of birth') }}</label>

                                <div class="col-md-6 input_value pb-2">
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}"
                                        autocomplete="date_of_birth" autofocus>

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row card_padding mb-0">
                                <div class="col-md-6 title_input">
                                    <button id="register_button" type="submit" class="btn button_reg">
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
