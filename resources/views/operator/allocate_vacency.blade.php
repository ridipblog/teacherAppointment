@extends('layouts.app')

@section('title', 'Operator Dashboard')

@section('extraCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')

    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Teacher's Appointment Letter Generation System, BTR</h1>
            </div>

            <!-- Tabs -->
            <nav class="mt-4 flex space-x-6 border-b border-blue-700 text-sm font-medium">
                <a href="{{ route('operator.index') }}"
                   id="tabCandidate"
                   class="py-2 px-4 border-b-2 transition {{ request()->routeIs('operator.index') ? 'border-white text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-white' }}">
                    Candidates
                </a>
                <a href="{{ route('operator.cuurentVacencyDistricts') }}"
                   id="tabRemaining"
                   class="py-2 px-4 border-b-2 transition {{ request()->routeIs('operator.cuurentVacencyDistricts') ? 'border-white text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-white' }}">
                    Vacancy
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8 space-y-8">

        <!-- Candidate Details -->
<section class="bg-white shadow border border-gray-200 rounded-lg p-8">
    <h2 class="text-xl font-semibold text-blue-800 mb-6">Candidate Details</h2>

    <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-sm text-gray-700">
        <div>
            <dt class="font-medium">Roll Number:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->rollNumber ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
        </div>
        <div>
            <dt class="font-medium">Name:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->name ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
        </div>
        <div>
            <dt class="font-medium">Post:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->allpost->name ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
        </div>
        <div>
            <dt class="font-medium">Father's Name:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->fatherName ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
        </div>
        <div>
            <dt class="font-medium">Address:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->address ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
        </div>
        <div>
            <dt class="font-medium">District:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->district ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
        </div>

        @if ($resData['candDetails']->allpost->id == 2)
            <div>
                <dt class="font-medium">PIN Code:</dt>
                <dd class="uppercase">{!! $resData['candDetails']->pinCode ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
            </div>
        @endif

        @if ($resData['candDetails']->allpost->id == 1)
            <div>
                <dt class="font-medium">Medium:</dt>
                <dd class="uppercase">{!! $resData['candDetails']->medium ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
            </div>
            <div>
                <dt class="font-medium">Stream:</dt>
                <dd class="uppercase">{!! $resData['candDetails']->category ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
            </div>
        @elseif ($resData['candDetails']->allpost->id == 2)
            <div>
                <dt class="font-medium">Subject:</dt>
                <dd class="uppercase">{!! $resData['candDetails']->subject ?? '<span class="italic text-gray-500">- Unavailable -</span>' !!}</dd>
            </div>
        @endif

        <div>
            <dt class="font-medium">DDO:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->vacency_details->school_vacency->ddo ?? '<span class="italic text-gray-500">- Not Assigned -</span>' !!}</dd>
        </div>
        <div>
            <dt class="font-medium">Group No:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->vacency_details->school_vacency->groupNo ?? '<span class="italic text-gray-500">- Not Assigned -</span>' !!}</dd>
        </div>
        <div>
            <dt class="font-medium">Cause of Vacancy:</dt>
            <dd class="uppercase">{!! $resData['candDetails']->vacency_details->couseOfPost ?? '<span class="italic text-gray-500">- Not Assigned -</span>' !!}</dd>
        </div>
    </dl>

    <!-- Download Button -->
    <div class="flex justify-center mt-8">
        <a href="{{ route('operator.downloadAppoint', ['candRoll' => $resData['candRoll'] ?? null]) }}" 
           class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition {{ $resData['candDetails']->isAllocated == 1 ? '' : 'hidden' }}" 
           id="download-appoint">
            ⬇️ Download PDF
        </a>
    </div>
</section>


        <!-- Error or Allocation -->
        @if (($resData['statusCode'] ?? 400) == 400)
            <div class="max-w-md mx-auto">
                <div class="flex items-start space-x-3 bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded-md shadow-sm">
                    <svg class="w-5 h-5 mt-1 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                    </svg>
                    <p class="text-sm font-medium">{{ $resData['message'] ?? 'Server error, please try again later.' }}</p>
                </div>
            </div>
        @else
            <div class="max-w-xl mx-auto">
                <div class="bg-white border shadow-md rounded-lg p-8">
                    <h2 class="text-lg font-semibold text-blue-800 mb-6">Search by School Code</h2>

                    <form id="allocate-form" class="space-y-6">
                        <!-- School Code -->
                        <div>
                            <label for="schoolCode" class="block text-sm font-medium text-gray-700">Preferred School Code</label>
                            <input type="text" name="schoolCode" id="schoolCode" required
                                   placeholder="Enter School Code"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 uppercase">
                            <input type="hidden" name="candRoll" value="{{ $resData['candRoll'] ?? null }}">
                        </div>

                        <!-- Post Type -->
                        <div>
                            <label for="schoolType" class="block text-sm font-medium text-gray-700">Select School Type</label>
                            <select name="postID" id="schoolType"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>-- Select Post Type --</option>
                                @foreach ($resData['posts'] ?? [] as $post)
                                    <option value="{{ $post->id ?? 0 }}">{{ $post->name ?? null }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-md transition">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        @endif




    <!-- Go Back -->
    <div class="flex items-center justify-center px-4 mt-4">
        <a href="{{ route('operator.index') }}" class="inline-flex items-center text-blue-700 hover:text-blue-900">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Candidates
        </a>
    </div>

    </main>
@endsection

@section('extraJs')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>
@endsection
