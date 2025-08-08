@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:6%">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm rounded-lg border-animate">
                <div class="card-header bg-gradient-blue text-white py-3">
                    <h4 class="text-center my-0">{{ __('Login') }}</h4>
                </div>

                <div class="card-body px-3 py-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-muted small mb-1">{{ __('Email Address') }}</label>
                            <div class="input-group input-group-sm">

                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}"  autocomplete="email" autofocus
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

                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                                       name="password"  autocomplete="current-password"
                                       placeholder="Enter password">
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

                        <!-- Remember Me -->
                        <div class="mb-3 form-check small">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
<div class="text-center mt-2 small text-muted">
    Don't have an account?
    <a href="{{ route('register') }}" class="text-decoration-none">{{ __('Register') }}</a>
</div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-gradient rounded-pill py-2">
                                {{ __('Login') }} <i class="bi bi-box-arrow-in-right ms-1"></i>
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styling (Same as Register Form) -->
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
        border: 2px solid transparent;
        border-radius: 10px;
        background-image: linear-gradient(#fff, #fff), linear-gradient(135deg, #00d2ff, #1d2632);
        background-origin: border-box;
        background-clip: content-box, border-box;
    }

     .form-control, .form-control-sm {
        height: 35px;
    }



    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
</style>

<!-- Bootstrap Icons -->
@endsection
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
</script>
