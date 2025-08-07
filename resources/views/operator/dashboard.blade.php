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
            <div class="mt-4 flex space-x-4 border-b border-blue-700">
                <a href="{{ route('operator.index') }}" id="tabCandidate"
                    class="py-2 px-4 text-sm font-medium border-b-2 border-white focus:outline-none">
                    Candidates
                </a>
                <a href="{{ route('operator.cuurentVacencyDistricts') }}" id="tabRemaining"
                    class="py-2 px-4 text-sm font-medium border-b-2 border-transparent hover:border-white focus:outline-none">
                    Vacancy
                </a href="">
            </div>
        </div>
    </header>

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
        <!-- Main Content -->
        <main class="max-w-7xl w-full mx-auto px-4 py-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-blue-800">Overview</h2>
            </div>

            <!-- DataTable -->
            <div class="bg-white shadow border p-2 overflow-x-auto">
                <table id="candidateTable" class="stripe hover w-full text-sm text-left">
                    <thead class="bg-blue-100 text-blue-800 uppercase text-sm font-bold uppercase">
                        <tr>
                            <th>Roll No.</th>
                            <th>Post</th>
                            <th>Candidate Name</th>
                            <th>Subject</th>
                            <th>Medium</th>
                            <th>Address</th>
                            <th>District</th>
                            <th>Stream</th>
                            <th>Allotted Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="uppercase">
                        @foreach ($resData['candidateData'] ?? [] as $data)
                            <tr>
                                <td>{{ $data->rollNumber ?? null }}</td>
                                <td>{{ $data->allpost->name ?? null }}</td>
                                <td>{{ $data->name ?? null }}</td>
                                <td>{{ $data->subject ?? null }}</td>
                                <td>{{ $data->medium ?? null }}</td>
                                <td>{{ $data->address ?? null }}</td>
                                <td>{{ $data->district ?? null }}</td>
                                <td>{{ $data->category ?? null }}</td>
                                <td><span
                                        class="text-green-600 font-semibold">{{ ($data->isAllocated ?? null) == 1 ? 'Yes' : 'No' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('operator.searchCandRoll', ['candRoll' => Crypt::encryptString($data->rollNumber ?? null)]) }}"
                                        class="text-blue-600 px-3 py-1 rounded hover:underline text-xs">
                                        Details
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        <!-- More rows -->
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
