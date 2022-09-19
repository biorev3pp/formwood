@extends('layouts.app')

@section('content')
<div class="app-content content">
    <div class="content-header row"></div>
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 box-shadow-1 p-0 m-1">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center pr-0">
                                    <div class="p-1"><img src="{{ asset('backend/images/logo.png') }}" class="logo-img" alt="Formwood"></div>
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="card-subtitle line-on-side fw-500 text-center font-small-3 mx-2"><span>Easily Reset Your Password</span></p>
                                <div class="card-body pt-0">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="email">Your Email</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autocomplete="off">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </fieldset>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-lg btn-block">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                        <div class="text-center">
                                            <a class="card-link" href="{{ route('login') }}">
                                                {{ __('Click Here To Login') }}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
