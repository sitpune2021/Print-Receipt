@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:6%">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-animate shadow-sm rounded-lg">
                <div class="card-header bg-gradient-blue text-white py-3">
                    <h4 class="text-center my-0">{{ __('Create Account') }}</h4>
                </div>

                <div class="card-body px-3 py-3">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label text-muted small mb-1">Full Name</label>
                            <div class="input-group input-group-sm">
                                <input id="name" type="text"
                                       class="form-control form-control-sm"
                                       name="name" value="{{ old('name') }}" autocomplete="name" autofocus
                                       placeholder="Your full name">
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-block small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-muted small mb-1">{{ __('Email') }}</label>
                            <div class="input-group input-group-sm">
                                <input id="email" type="email" class="form-control form-control-sm"
                                       name="email" value="{{ old('email') }}" autocomplete="email"
                                       placeholder="Your email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label text-muted small mb-1">{{ __('Password') }}</label>
                            <div class="input-group input-group-sm">
                                <input id="password" type="password"
                                       class="form-control form-control-sm @error('password') is-invalid @enderror"
                                       name="password" autocomplete="new-password"
                                       placeholder="Create password">
                                <span class="input-group-text" onclick="togglePassword('password', 'toggle-icon1')" style="cursor: pointer;">
                                    <i class="fa fa-eye-slash" id="toggle-icon1"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label text-muted small mb-1">{{ __('Confirm Password') }}</label>
                            <div class="input-group input-group-sm">
                                <input id="password-confirm" type="password"
                                       class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                                       name="password_confirmation" autocomplete="new-password"
                                       placeholder="Confirm password">
                                <span class="input-group-text" onclick="togglePassword('password-confirm', 'toggle-icon2')" style="cursor: pointer;">
                                    <i class="fa fa-eye-slash" id="toggle-icon2"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback d-block small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-gradient rounded-pill py-2">
                                {{ __('Register') }} <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>

                        <div class="text-center mt-2 small text-muted">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Login') }}</a>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
    .bg-gradient-blue {
        background: linear-gradient(135deg, #00d2ff 0%, #1d2632 100%);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #00d2ff 0%, #1d2632 100%);
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #00c4f0 0%, #151b24 100%);
        transform: translateY(-1px);
    }

    .card {
        border: none;
        border-radius: 10px;
        background-image: linear-gradient(#fff, #fff), linear-gradient(135deg, #00d2ff, #1d2632);
        background-origin: border-box;
        background-clip: content-box, border-box;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    .form-control
    {
        height:37px;
    }


</style>

<script>
    function togglePassword(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    // Password restore logic
    document.addEventListener("DOMContentLoaded", function () {
        const passwordField = document.getElementById("password");
        const confirmField = document.getElementById("password-confirm");

        const savedPassword = sessionStorage.getItem("register_password");
        const savedConfirm = sessionStorage.getItem("register_password_confirm");

        // If available (only on validation error), restore
        if (savedPassword) passwordField.value = savedPassword;
        if (savedConfirm) confirmField.value = savedConfirm;

        // Save on submit
        const form = document.querySelector("form");
        form.addEventListener("submit", function () {
            sessionStorage.setItem("register_password", passwordField.value);
            sessionStorage.setItem("register_password_confirm", confirmField.value);
        });
    });

    // Optional: Clear on success (you can also clear it manually after redirect)
    if (window.location.pathname === '/register') {
        if (!document.querySelector('.invalid-feedback')) {
            sessionStorage.removeItem("register_password");
            sessionStorage.removeItem("register_password_confirm");
        }
    }
</script>

@endsection
