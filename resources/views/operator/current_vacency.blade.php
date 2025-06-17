@extends('layouts.app')
@section('refressMeta')
    <meta http-equiv="refresh" content="3">
@endsection
@section('title', 'Operator Dashboard')

@section('extraCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')

    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Allocate Dashboard</h1>
            </div>

            <!-- Tabs -->
            <div class="mt-4 flex space-x-4 border-b border-blue-700">
                <a href="{{ route('operator.index') }}" id="tabCandidate"
                    class="py-2 px-4 text-sm font-medium border-b-0 hover:border-b-2  focus:outline-none">
                    Candidate
                </a>
                <a href="{{ route('operator.CurrentVacency') }}" id="tabRemaining"
                    class="py-2 px-4 text-sm font-medium border-b-2 border-transparent border-white focus:outline-none">
                    Current Vacency
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
        <main class="max-w-7xl mx-auto px-4 py-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-blue-800">Vacancy Records Overview</h2>
            </div>

            <!-- Flex container for two tables -->
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- First Table -->
                <div class="bg-white shadow rounded-lg overflow-x-auto w-full lg:w-1/2">
                    <table id="vacancyTable" class="stripe hover w-full text-sm text-left">
                        <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-bold">
                            <tr>
                                <th>School Code</th>
                                <th>School Name</th>
                                <th>Post</th>
                                <th>Vacency Category</th>
                                <th>Remaing Vacency</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resData['currentVacency'] ?? [] as $data)
                                <tr>
                                    <td>{{ $data->school_vacency->schoolCode ?? null }}</td>
                                    <td>{{ $data->school_vacency->schoolName ?? null }}</td>
                                    <td>{{ $data->school_vacency->allpost->name ?? null }}</td>
                                    <td>{{ $data->school_vacency->vacencyCategory ?? null }}</td>
                                    <td>{{ $data->remaingVacency ?? 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Second Table (duplicate layout for example) -->
                <div class="bg-white shadow rounded-lg overflow-x-auto w-full lg:w-1/2">
                    <table id="vacancyTable2" class="stripe hover w-full text-sm text-left">
                        <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-bold">
                            <tr>
                                <th>School Code</th>
                                <th>School Name</th>
                                <th>Post</th>
                                <th>Vacency Category</th>
                                <th>Remaing Vacency</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($resData['currentVacency2'] ?? [] as $data)
                                <tr>
                                    <td>{{ $data->school_vacency->schoolCode ?? null }}</td>
                                    <td>{{ $data->school_vacency->schoolName ?? null }}</td>
                                    <td>{{ $data->school_vacency->allpost->name ?? null }}</td>
                                    <td>{{ $data->school_vacency->vacencyCategory ?? null }}</td>
                                    <td>{{ $data->remaingVacency ?? 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

    @endif

@endsection

@section('extraJs')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>
@endsection
