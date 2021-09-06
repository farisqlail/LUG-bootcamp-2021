@extends('layout.auth')

@section('content')
<div class="card card-primary">
  <div class="card-header"><h4>Login</h4></div>

  <div class="card-body">
    <form method="POST" action="#">
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email">
      </div>

      <div class="form-group">
        <div class="d-block">
          <label for="password" class="control-label">Password</label>
        </div>
        <input id="password" type="password" class="form-control" name="password">
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