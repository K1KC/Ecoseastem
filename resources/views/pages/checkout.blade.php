@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Side: Contact & Shipping -->
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <!-- Contact Information -->
            <h2 class="text-xl font-semibold mb-4">Contact information</h2>
            <div class="mb-6">
                <label for="email" class="block text-gray-700">Email address</label>
                <input type="email" id="email" placeholder="Enter email"
                       class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Shipping Information -->
            <h2 class="text-xl font-semibold mb-4">Shipping information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-gray-700">First name</label>
                    <input type="text" id="first_name" placeholder="Enter first name"
                           class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="last_name" class="block text-gray-700">Last name</label>
                    <input type="text" id="last_name" placeholder="Enter last name"
                           class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="mt-4">
                <label for="address" class="block text-gray-700">Address</label>
                <input type="text" id="address" placeholder="Enter address"
                       class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="city" class="block text-gray-700">City</label>
                    <input type="text" id="city" placeholder="Enter city"
                           class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="country" class="block text-gray-700">Country</label>
                    <select id="country" class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option>United States</option>
                        <option>Canada</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="state" class="block text-gray-700">State / Province</label>
                    <input type="text" id="state" placeholder="Enter state"
                           class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="postal_code" class="block text-gray-700">Postal code</label>
                    <input type="text" id="postal_code" placeholder="Enter postal code"
                           class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="mt-4">
                <label for="phone" class="block text-gray-700">Phone</label>
                <input type="text" id="phone" placeholder="Enter phone number"
                       class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <!-- Right Side: Order Summary -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Order summary</h2>

            <!-- Items -->
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <div class="flex items-center space-x-4">
                    <img src="https://via.placeholder.com/50" alt="Basic Tee" class="w-12 h-12 rounded">
                    <div>
                        <p class="text-gray-700">Basic Tee</p>
                        <p class="text-sm text-gray-500">Black, Large</p>
                    </div>
                </div>
                <p class="text-gray-700">Rp 32.00</p>
            </div>

            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <div class="flex items-center space-x-4">
                    <img src="https://via.placeholder.com/50" alt="Basic Tee" class="w-12 h-12 rounded">
                    <div>
                        <p class="text-gray-700">Basic Tee</p>
                        <p class="text-sm text-gray-500">Sienna, Large</p>
                    </div>
                </div>
                <p class="text-gray-700">Rp 32.00</p>
            </div>

            <!-- Summary -->
            <div class="space-y-2 text-gray-700">
                <div class="flex justify-between">
                    <p>Subtotal</p>
                    <p>Rp 64.00</p>
                </div>
                <div class="flex justify-between">
                    <p>Shipping</p>
                    <p>Rp 5.00</p>
                </div>
                <div class="flex justify-between">
                    <p>Taxes</p>
                    <p>Rp 5.52</p>
                </div>
                <div class="flex justify-between font-semibold text-lg">
                    <p>Total</p>
                    <p>Rp 75.52</p>
                </div>
            </div>

            <!-- Confirm Button -->
            <div class="mt-6">
                <button class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">
                    Confirm order
                </button>
            </div>
        </div>
    </div>
</div>
@endsection