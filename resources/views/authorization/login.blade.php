@extends('layouts.app')

@section('title', 'Login Page')

@section('content')

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-2xl p-12 w-full max-w-xl w-full border-t-4 border-blue-900">
            <div class="mb-12 text-center">
                <h1 class="text-3xl font-bold text-blue-900">Teacher's Appointment Letter Generation System, BTR</h1>
                <p class="text-sm text-gray-600">Secure access for authorized users</p>
            </div>

            <form id="login-form">
                <!-- Phone Number -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700" />
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-900 text-white py-2 rounded-lg hover:bg-blue-800 transition duration-300 my-6"
                    id="login-btn">
                    Login
                </button>
            </form>

            <!-- Optional Note -->
            <p class="mt-4 text-xs text-gray-500 text-center">
                For assistance, contact your system administrator.
            </p>
        </div>
    </div>

@endsection

@section('extraJs')
    <script type="module" src="{{ asset('js/Authorization/auth.js') }}"></script>
@endsection
