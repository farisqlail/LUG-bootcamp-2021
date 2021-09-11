@extends('layout.auth')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="/auth/register">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" class="form-control @error('nama')is-invalid @enderror" name="nama"
                        value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control @error('username')is-invalid @enderror"
                        name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" type="text" class="form-control @error('alamat')is-invalid @enderror" name="alamat"
                        value="{{ old('alamat') }}" required>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input id="nohp" type="text" class="form-control @error('nohp')is-invalid @enderror" name="nohp"
                        value="{{ old('nohp') }}" required>
                    @error('nohp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
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
                        Register
                    </button>
                </div>
            </form>

        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        I have account? <a href="{{ route('login') }}">Login</a>
    </div>
@endsection
