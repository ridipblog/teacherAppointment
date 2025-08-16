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
            <div class="mt-4 flex space-x-6 border-b border-blue-700 text-sm font-medium">
                <a href="{{ route('operator.index') }}" 
                   id="tabCandidate"
                   class="py-2 px-4 border-b-2 {{ request()->routeIs('operator.index') ? 'border-white text-white' : 'border-transparent text-blue-100 hover:border-white hover:text-white' }}">
                    Candidates
                </a>
                <a href="{{ route('operator.cuurentVacencyDistricts') }}" 
                   id="tabRemaining"
                   class="py-2 px-4 border-b-2 {{ request()->routeIs('operator.cuurentVacencyDistricts') ? 'border-white text-white' : 'border-transparent text-blue-100 hover:border-white hover:text-white' }}">
                    Vacancy
                </a>
            </div>
        </div>
    </header>

    @if (($resData['statusCode'] ?? 400) == 400)
        <!-- Error Alert -->
        <div class="max-w-md mx-auto mt-6">
            <div class="flex items-start space-x-3 bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded-md shadow-sm">
                <!-- Icon -->
                <svg class="w-5 h-5 mt-0.5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>

                <!-- Text -->
                <p class="text-sm font-medium">
                    {{ $resData['message'] ?? 'Server error. Please try again later.' }}
                </p>
            </div>
        </div>
    @else
        <!-- Main Content -->
        <main class="max-w-7xl w-full mx-auto px-4 py-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-blue-800">Candidates Overview</h2>
                <p class="text-gray-500 text-sm">Select a candidate to view details.</p>
            </div>

            <!-- DataTable -->
            <div class="bg-white shadow-md rounded-lg border overflow-x-auto">
                <table id="candidateTable" class="stripe hover w-full text-sm">
                    <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-bold">
                        <tr>
                            <th>Roll No.</th>
                            <th>Post</th>
                            <th>Candidate</th>
                            <th>Subject</th>
                            <th>Medium</th>
                            <th>Address</th>
                            <th>District</th>
                            <th>Stream</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resData['candidateData'] ?? [] as $data)
                            <tr>
                                <td>{{ $data->rollNumber ?? '-' }}</td>
                                <td>{{ $data->allpost->name ?? '-' }}</td>
                                <td class="font-medium">{{ $data->name ?? '-' }}</td>
                                <td>{{ $data->subject ?? '-' }}</td>
                                <td>{{ $data->medium ?? '-' }}</td>
                                <td>{{ $data->address ?? '-' }}</td>
                                <td>{{ $data->district ?? '-' }}</td>
                                <td>{{ $data->category ?? '-' }}</td>
                                <td>
                                    <span class="{{ ($data->isAllocated ?? 0) == 1 ? 'text-green-600 font-semibold' : 'text-red-600 font-medium' }}">
                                        {{ ($data->isAllocated ?? 0) == 1 ? 'Allotted' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('operator.searchCandRoll', ['candRoll' => Crypt::encryptString($data->rollNumber ?? '')]) }}"
                                       class="text-blue-600 hover:text-blue-800 hover:underline text-xs font-semibold">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    @endif

@endsection

@section('extraJs')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>
@endsection
