@include('layouts.login')
<div class="login-box"> 
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Project</b>Test</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg h4">Log in</p>
      <form method="POST" action="{{ route('login') }}">
      @csrf
        <div class="input-group mb-3">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="input-group mb-3"> 
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> 
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Login') }}
            </button>
 
          </div> 
        </div>
      </form>
 
      <!-- @if (Route::has('password.request'))
           <a class="btn btn-link" href="{{ route('password.request') }}">
               {{ __('Forgot Your Password?') }}
           </a>
      @endif  -->
    </div> 
  </div> 
</div>