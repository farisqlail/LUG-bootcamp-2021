@extends('layout.auth')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @elseif(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="/auth/login">
                @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email')is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control @error('password')is-invalid @enderror"
                    name="password" value="{{ old('password') }}" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Don't have an account? <a href="{{ route('register') }}">Create One</a>
    </div>
@endsection
