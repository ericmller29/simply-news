@extends('layouts.base')

@section('content')
<div class="container">
    <div class="panel">
        <div class="panel-heading with-margin-bottom">Login</div>
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-input with-margin-bottom{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
                @if ($errors->has('username'))
                    <span class="help-block">
                        {{ $errors->first('username') }}
                    </span>
                @endif
            </div>
            <div class="form-input with-margin-bottom{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="form-input text-center with-margin-bottom">
                <button type="submit" class="btn">Login</button>
            </div>
            <div class="form-input text-center">
                <a class="forgot-link" href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        </form>
    </div>
</div>
@endsection
