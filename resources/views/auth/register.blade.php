@extends('layouts.register')

@section('conten')

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                     
                        {{-- form-control --}}
                        <div class="form-group">
                            <div class="col">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- form-control --}}
                        <div class="form-group">
                            <div class="col">
                                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                <div class="md-6">
                                    <input id="username" type="text" class="form-control @error('usermane') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- form-control --}}
                        <div class="form-group">
                            <div class="col">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- form-control --}}
                        <div class="form-group">
                            <div class="col">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- form-control --}}
                        <div class="form-group">
                            <div class="col">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            </div>
                        </div>

                        
                        <div class="form-group mt-5">
                            <div class="col">
                            <button type="submit" style="border-radius: 6px; background: var(--primary-500-base, #4EA971)" class="theme-btn btn-style-one"  name="register">@lang('auth.page.signup')</button>
                            
                        </div>
                        </div>
                    </form>
                </div>
@endsection
