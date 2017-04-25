@extends('layouts.base')

@section('content')
<div class="container">
    <div class="panel">
        <div class="panel-heading with-margin-bottom">Reset Password</div>
        
        <form role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-input with-margin-bottom{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-input text-center">
                <button type="submit" class="btn">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
