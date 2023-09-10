@extends('template.auth')

@section('content')
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1"
                        value="{{ old('email') }}" required autofocus>
                    <div class="invalid-feedback">Por favor, digite seu e-mail</div>
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                            <a href="{{ route('password.request') }}" class="text-small">
                                Esqueceu sua senha?
                            </a>
                        </div>
                    </div>
                    <input id="password" type="password" class="form-control" type="password" name="password" required
                        autocomplete="current-password" tabindex="2" required>
                    <div class="invalid-feedback">Por favor, digite sua senha</div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                            id="remember-me">
                        <label class="custom-control-label" for="remember-me">Lembrar-me</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>


            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

      

        </div>
    </div>

    <div class="mt-5 text-muted text-center">
        Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
    </div>

</div>

@endsection