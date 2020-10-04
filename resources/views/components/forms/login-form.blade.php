<form method="POST" action="{{route($route)}}">
      @csrf
      <x-inputs.input
        name="email"
        type="email"
        icon="envelope"
        label="email"
        placeholder="Email"
        required="true"
    ></x-inputs.input>
    <x-inputs.input
        name="password"
        type="password"
        icon="lock"
        label="password"
        placeholder="Mot de Passe"
        required="true"
    ></x-inputs.input>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name= "remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
              {{__('Remember Me')}}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn_login">{{__('Login')}}</button>
          </div>
          <!-- /.col -->
        </div>
</form>
<p class="mb-1">
    <a href="{{route('register')}}">{{__('Register')}}</a>
    </p>
    <p class="mb-0">
        @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
    @endif
</p>