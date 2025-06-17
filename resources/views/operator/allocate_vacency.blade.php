@extends('layouts.app')

@section('title', 'Operator Dashboard')

@section('extraCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')

    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Allocate Dashboard</h1>
            {{-- <span class="text-sm">Gov Portal</span> --}}
        </div>
    </header>

    <!-- Go Back Button -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <a href="{{ route('operator.index') }}" class="inline-flex items-center text-blue-700 hover:text-blue-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="operator">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>

    {{-- *** Show Error Message Pop up *** --}}


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8 space-y-6">

        <!-- Candidate Info -->
        <section class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
            <h2 class="text-xl font-semibold text-blue-800 mb-4">Candidate Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-gray-700">
                <div><strong>rollNumber:</strong> {{ $resData['candDetails']->rollNumber ?? 'Not Mention' }}</div>
                <div><strong>post:</strong> {{ $resData['candDetails']->allpost->name ?? 'Not Mention' }}</div>
                <div><strong>name:</strong> {{ $resData['candDetails']->name ?? 'Not Mention' }}</div>
                <div><strong>fatherName:</strong> {{ $resData['candDetails']->fatherName ?? 'Not Mention' }}</div>
                <div><strong>subject:</strong> {{ $resData['candDetails']->subject ?? 'Not Mention' }}</div>
                <div><strong>address:</strong> {{ $resData['candDetails']->address ?? 'Not Mention' }}</div>
                <div><strong>district:</strong> {{ $resData['candDetails']->district ?? 'Not Mention' }}</div>
                <div><strong>pinCode:</strong> {{ $resData['candDetails']->pinCode ?? 'Not Mention' }}</div>
                <div><strong>medium:</strong> {{ $resData['candDetails']->medium ?? 'Not Mention' }}</div>
                <div><strong>category:</strong> {{ $resData['candDetails']->category ?? 'Not Mention' }}</div>
                {{-- <div><strong>allocatedSchoolCode:</strong> {{ $resData['candDetails']->allocatedSchoolCode ?? null }}</div>
                <div><strong>generatedBy:</strong> {{ $resData['candDetails']->generatedBy ?? null }}</div>
                <div><strong>generatedOn:</strong> {{ $resData['candDetails']->generatedOn ?? null }}</div>
                <div><strong>isAllocated:</strong> {{ $resData['candDetails']->isAllocated ?? null }}</div> --}}
            </div>

            <a href="{{ route('operator.downloadAppoint', ['candRoll' => $resData['candRoll'] ?? null]) }}" download
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition duration-200 {{$resData['candDetails']->isAllocated == 1 ?'' : 'hidden'}}" id="download-appoint">
                ⬇️ Download PDF
            </a>

        </section>

        @if (($resData['statusCode'] ?? 400) == 400)
            <div class="max-w-md mx-auto">
                <div
                    class="flex items-start space-x-3 bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded-md shadow-sm">
                    <!-- Icon (optional) -->
                    <svg class="w-5 h-5 mt-1 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                    </svg>

                    <!-- Error Message Text -->
                    <div class="text-sm font-medium">
                        {{ $resData['message'] ?? 'Server error please try later ' }}
                    </div>
                </div>
            </div>
        @else
            <div class="max-w-md mx-auto mt-10">
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-blue-800 mb-4">Search by School Code</h2>

                    <form class="space-y-4" id="allocate-form">
                        <div>
                            <label for="schoolCode" class="block text-sm font-medium text-gray-700">School Code</label>
                            <input type="text" name="schoolCode" id="schoolCode" required placeholder="Enter School Code"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <input type="hidden" name="candRoll" value="{{ $resData['candRoll'] ?? null }}">
                        </div>

                        <!-- New Select Box -->
                        <div>
                            <label for="schoolType" class="block text-sm font-medium text-gray-700">Select School
                                Type</label>
                            <select name="postID" id="schoolType"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" selected disabled>-- Select Post Type --</option>
                                @foreach ($resData['posts'] ?? [] as $post)
                                    <option value="{{ $post->id ?? 0 }}">{{ $post->name ?? null }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-md transition"
                                id="allocate-btn">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </main>

@endsection

@section('extraJs')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>
@endsection
