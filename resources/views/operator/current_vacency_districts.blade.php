@extends('layouts.app')
@section('refressMeta')
    <!-- <meta http-equiv="refresh" content="30"> -->
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
        <main class="max-w-7xl mx-auto w-full px-4 py-6 flex flex-col items-center">
    <!-- Page Heading -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-blue-800">Vacancy Records Overview</h2>
        <p class="text-sm text-gray-500">Select a district to view current vacancies</p>
    </div>

    <!-- Parent Card (Centered) -->
    <div class="bg-white shadow-lg rounded-2xl border w-full max-w-xs">
        <!-- Card Header -->
        <div class="px-5 py-3 border-b bg-blue-100 text-blue-800 font-bold uppercase text-sm rounded-t-2xl">
            Districts
        </div>

        <!-- Card Body with List Group -->
        <ul class="divide-y divide-gray-200">
            @foreach ($resData['districts'] ?? [] as $district)
                <li>
                    <a href="{{ Route('operator.CurrentVacency', ['districts' => $district->district ?? null]) }}"
                       class="block px-6 py-4 text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition rounded-b-2xl flex items-center justify-between gap-4">
                        <span>{{ $district->district ?? 'Unknown' }}</span><span><i class="bi bi-arrow-right"></i></span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</main>


    @endif

@endsection

@section('extraJs')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>
@endsection
