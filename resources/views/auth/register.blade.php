@extends('layouts.register')

@section('conten')
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row form-group">
            <div class="col">
                <label>@lang('auth.page.name')</label>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="@lang('auth.page.name')" value="{{ old('name') }}"  required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col">
                <label>@lang('auth.page.username')</label>
                <input type="text" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="@lang('auth.page.username')"  required>
            @if ($errors->has('username'))
                <span class="invalid-feedback">{{ $errors->first('username') }}</span>
            @endif
            </div>
        </div>

        <div class="form-group">

            <label>@lang('auth.page.email')</label>
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('auth.page.email')"  required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
            @endif

        </div>
        
        <div class="form-group">
            <label>@lang('auth.page.password')</label>
            <input id="password" type="password" placeholder="@lang('auth.page.password')"
            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>@lang('auth.page.passwordConfirm')</label>
            <input id="password-confirm" type="password" placeholder="@lang('auth.page.passwordConfirm')"
            class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" name="password_confirmation" required autocomplete="new-password">
            @if ($errors->has('password-confirm'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password-confirm') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group mt-5">
            <button style="border-radius: 6px; background: var(--primary-500-base, #4EA971)" class="theme-btn btn-style-one" type="submit" name="register">@lang('auth.page.signup')</button>
        </div>
    </form>


@endsection
