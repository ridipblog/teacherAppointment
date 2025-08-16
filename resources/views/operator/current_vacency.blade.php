@extends('layouts.app')
@section('refressMeta')
    <!-- <meta http-equiv="refresh" content="20"> -->
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
                <h1 class="text-2xl font-bold">Teacher's Appointment Letter Generation System, BTR</h1>
            </div>

            <!-- Tabs -->
            <!-- <div class="mt-4 flex space-x-4 border-b border-blue-700">
                <a href="{{ route('operator.index') }}" id="tabCandidate"
                    class="py-2 px-4 text-sm font-medium border-b-2 border-transparent hover:border-white focus:outline-none">
                    Candidates
                </a>
                <a href="{{ route('operator.cuurentVacencyDistricts') }}" id="tabRemaining"
                    class="py-2 px-4 text-sm font-medium border-b-2 border-white focus:outline-none">
                    Vacancy
                </a href="">
            </div> -->
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
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-blue-800">Vacancy Records Overview</h2>
        <div class="flex items-center justify-between mb-4">
    <p class="text-gray-500 text-">Please refresh the page to see the latest records.</p>
    <button onclick="window.location.reload()" 
        class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition"> <i class="bi bi-arrow-repeat mr-1"></i>
        Refresh Now
    </button>
</div>
    </div>

    <!-- Flex container -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- First Card -->
        <div class="bg-white shadow-md rounded-lg border w-full lg:w-1/2">
            <!-- Card Header -->
            <div class="px-4 py-2 border-b bg-blue-100 text-blue-800 font-bold uppercase text-sm">
                Current Vacancy (Set 1)
            </div>

            <!-- Card Body -->
            <div class="p-2 overflow-x-auto">
                <table id="vacancyTable" class="stripe hover w-full text-sm text-left uppercase">
                    <thead class="bg-blue-50 text-blue-700 text-xs font-semibold">
                        <tr>
                            <th>School Code</th>
                            <th>School Name</th>
                            <th>District</th>
                            <th>Post</th>
                            <th>Medium</th>
                            <th>Stream</th>
                            <th class="text-center">Vacancy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resData['currentVacency'] ?? [] as $data)
                            <tr>
                                <td>{{ $data->school_vacency->schoolCode ?? null }}</td>
                                <td>{{ $data->school_vacency->schoolName ?? null }}</td>
                                <td>{{ $data->school_vacency->district ?? null }}</td>
                                <td>{{ $data->school_vacency->allpost->name ?? null }}</td>
                                <td>{{ $data->school_vacency->medium ?? null }}</td>
                                <td>{{ $data->school_vacency->vacencyCategory ?? null }}</td>
                                <td class="text-center font-semibold text-blue-700">{{ $data->remaingVacency ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Second Card -->
        <div class="bg-white shadow-md rounded-lg border w-full lg:w-1/2">
            <!-- Card Header -->
            <div class="px-4 py-2 border-b bg-blue-100 text-blue-800 font-bold uppercase text-sm">
                Current Vacancy (Set 2)
            </div>

            <!-- Card Body -->
            <div class="p-2 overflow-x-auto">
                <table id="vacancyTable2" class="stripe hover w-full text-sm text-left uppercase">
                    <thead class="bg-blue-50 text-blue-700 text-xs font-semibold">
                        <tr>
                            <th>School Code</th>
                            <th>School Name</th>
                            <th>District</th>
                            <th>Post</th>
                            <th>Subject</th>
                            <th class="text-center">Vacancy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resData['currentVacency2'] ?? [] as $data)
                            <tr>
                                <td>{{ $data->school_vacency->schoolCode ?? null }}</td>
                                <td>{{ $data->school_vacency->schoolName ?? null }}</td>
                                <td>{{ $data->school_vacency->district ?? null }}</td>
                                <td>{{ $data->school_vacency->allpost->name ?? null }}</td>
                                <td>{{ $data->school_vacency->vacencyCategory ?? null }}</td>
                                <td class="text-center font-semibold text-blue-700">{{ $data->remaingVacency ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

    @endif

@endsection

@section('extraJs')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>
@endsection
