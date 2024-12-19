@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<section id="profile" class="bg-white mt-8 p-6 rounded-lg shadow-md text-center">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, Tony Barks</h2>
    <div class="mt-4">
        <img src="https://picsum.photos/200" alt="Tony Barks" class="w-24 h-24 mx-auto rounded-full object-cover">
    </div>
    <div class="mt-4 text-gray-600">
        <p><span class="font-semibold">Name:</span> Tony Barks</p>
        <p><span class="font-semibold">Rank:</span> Turtle helper</p>
        <p><span class="font-semibold">Email:</span> tonybarksikledaog@yahoo.co.id</p>
        <p><span class="font-semibold">Location:</span> New Zealand, Auckland</p>
        <p><span class="font-semibold">Total Transaction:</span> Rp. 50.000,00</p>
    </div>
    <a href="/bookmark"
        class="block mt-6 text-teal-700 font-semibold hover:underline">Go to bookmarks</a>
</section>
@endsection