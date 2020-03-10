@extends('layouts.masterauth')

@section('content')

    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <fieldset class="form-group position-relative has-icon-left">
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="correo@dominio.com" required autofocus>
                <div class="form-control-position">
                    <i class="ft-user"></i>
                </div>
            </fieldset>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <fieldset class="form-group position-relative has-icon-left">
                <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                
                <div class="form-control-position">
                    <i class="la la-key"></i>
                </div>
                </fieldset>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            <div class="form-group row">
            <div class="col-md-6 col-12 text-center text-sm-left">
                <fieldset>
                <input type="checkbox" id="remember-me" class="chk-remember">
                <label for="remember-me"> Remember Me</label>
                </fieldset>
            </div>
            <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
            </div>
            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
        </form>
    </div>
    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
        <span>Nuevo en EasyOrder ?</span>
    </p>
    <div class="card-body">
        <a href="{{route('register')}}" class="btn btn-outline-danger btn-block"><i class="ft-user"></i> Registrate</a>
    </div>
@endsection
