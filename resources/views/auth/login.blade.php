@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">@lang('messages.login.heading')</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">{{ __('messages.login.email') }}</label>
                <div class="mt-2">
                    <input id="email" type="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-900">{{ __('messages.login.password') }}</label>
                <div class="mt-2">
                    <input id="password" type="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        {{ __('messages.login.rememberMe') }}
                    </label>
                </div>

                <div class="text-sm">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('messages.login.forgot.password') }}
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <button type="submit" class="w-full rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ __('messages.login.button') }}
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
           {{__('messages.login.toRegister') }}
            <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">{{__('messages.login.toRegister.link') }}</a>
        </p>
    </div>
</div>

@endsection
