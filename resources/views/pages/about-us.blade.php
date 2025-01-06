@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-indigo-600 mb-4">{{ __('messages.about_us_title') }}</h1>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_intro') }}</p>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_belief') }}</p>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_merch') }}</p>
        <p class="text-gray-700 text-lg mb-4">{{ __('messages.about_us_call_to_action') }}</p>
    </div>
</div>
@endsection