@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">{{ __('messages.register.heading') }}</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">{{ __('messages.register.name') }}</label>
                <div class="mt-2">
                    <input id="name" type="text" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">{{ __('messages.register.email') }}</label>
                <div class="mt-2">
                    <input id="email" type="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-900">{{ __('messages.register.password') }}</label>
                <div class="mt-2">
                    <input id="password" type="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password-confirm" class="block text-sm/6 font-medium text-gray-900">{{ __('messages.register.confirm') }}</label>
                <div class="mt-2">
                    <input id="password-confirm" type="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ __('messages.register.button') }}
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            {{ __('messages.register.toLogin') }}
            <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">{{ __('messages.register.toLogin.link') }}</a>
        </p>
    </div>
</div>

@endsection
