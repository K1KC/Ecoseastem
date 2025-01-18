@extends('layout.app')
@section('title', 'About Us Page')
@section('content')
<div class="container bg-cover bg-center mx-auto px-6 py-12 h-max" style="background-image: url('banner.jpg')">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-indigo-600 mb-4 text-center">{{ __('messages.about_us_title') }}</h1>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_intro') }}</p>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_belief') }}</p>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_merch') }}</p>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_call_to_action') }}</p>
    </div>
</div>
@endsection