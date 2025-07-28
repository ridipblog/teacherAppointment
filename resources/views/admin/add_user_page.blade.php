@php
    $data = null;
    $isError = null;
    $dataHeader = [];
    try {
        $data = $viewData['data'] ?? null;
        $dataHeader = $viewData['dataHeader'] ?? null;
        $isError = $viewData['isError'] ?? true;
    } catch (Exception $err) {
        $isError = true;
    }
@endphp

@extends('layouts.admin_layout')

@section('title', 'Candidate Details ')

{{-- *** Main Content *** --}}
@section('content')

    @if ($isError)
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <p class="">{{ $viewData['message'] ?? 'Some issue execute.' }}</p>
        </div>
    @else
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-xl p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New User</h2>

            <form>
                <!-- Full Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Select Role</option>
                        <option value="2">Admin</option>
                        <option value="1">User</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                        Create User
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white shadow border p-2 overflow-x-auto w-full mt-5">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Add New User</h2>
            <div class="overflow-x-auto">

                {{-- *** Report Table *** --}}
                <x-admin.all-user-table-component>

                </x-admin.all-user-table-component>
            </div>
        </div>
    @endif

@endsection

@section('extraJs')

    {{-- *** All Admin Js Code Here *** --}}
    <script type="module" src="{{ asset('js/Admin/admin.js') }}"></script>

@endsection
