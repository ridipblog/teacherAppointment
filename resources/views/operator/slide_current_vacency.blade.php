@extends('layouts.app')
@section('refressMeta')
    <meta http-equiv="refresh" content="20">
@endsection
@section('title', 'Operator Dashboard')

@section('extraCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
                    class="py-2 px-4 text-sm font-medium border-b-2 border-transparent hover:border-white focus:outline-none">
                    Candidates
                </a>
                <a href="{{ route('operator.cuurentVacencyDistricts') }}" id="tabRemaining"
                    class="py-2 px-4 text-sm font-medium border-b-2 border-white focus:outline-none">
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
        <main class="max-w-7xl mx-auto px-4 py-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-blue-800">Vacancy Records Overview</h2>
            </div>

            <!-- Swiper Container -->
            <div class="swiper swiper-1">
                <div class="swiper-wrapper">
                    @php
                        $chunks = collect($resData['currentVacency'] ?? [])->chunk(10);
                    @endphp

                    @foreach ($chunks as $chunk)
                        <div class="swiper-slide">
                            <table class="min-w-full border border-gray-300 rounded-md shadow-sm">
                                <thead class="bg-blue-800 text-white text-sm">
                                    <tr>
                                        <th class="px-4 py-2 text-left">School Code</th>
                                        <th class="px-4 py-2 text-left">School Name</th>
                                        <th class="px-4 py-2 text-left">Post</th>
                                        <th class="px-4 py-2 text-left">Post</th>
                                        <th class="px-4 py-2 text-left">Medium</th>
                                        <th class="px-4 py-2 text-left">Category</th>
                                        <th class="px-4 py-2 text-left">Remaing Vacency</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-200">
                                    @foreach ($chunk as $row)
                                        <tr>
                                            <td class="px-4 py-2">{{ $row->school_vacency->schoolCode ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->schoolName ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->district ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->allpost->name ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->medium ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->vacencyCategory ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->remaingVacency ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>

                <!-- Swiper Controls -->
                <div class="swiper-pagination mt-4"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <div class="swiper swiper-2 mt-5">
                <div class="swiper-wrapper">
                    @php
                        $chunks = collect($resData['currentVacency2'] ?? [])->chunk(10);
                    @endphp

                    @foreach ($chunks as $chunk)
                        <div class="swiper-slide">
                            <table class="min-w-full border border-gray-300 rounded-md shadow-sm">
                                <thead class="bg-blue-800 text-white text-sm">
                                    <tr>
                                        <th class="px-4 py-2 text-left">School Code</th>
                                        <th class="px-4 py-2 text-left">School Name</th>
                                        <th class="px-4 py-2 text-left">Post</th>
                                        <th class="px-4 py-2 text-left">Post</th>
                                        <th class="px-4 py-2 text-left">Medium</th>
                                        <th class="px-4 py-2 text-left">Category</th>
                                        <th class="px-4 py-2 text-left">Remaing Vacency</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-200">
                                    @foreach ($chunk as $row)
                                        <tr>
                                            <td class="px-4 py-2">{{ $row->school_vacency->schoolCode ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->schoolName ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->district ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->allpost->name ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->medium ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->school_vacency->vacencyCategory ?? null }}</td>
                                            <td class="px-4 py-2">{{ $row->remaingVacency ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>

                <!-- Swiper Controls -->
                <div class="swiper-pagination mt-4"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </main>


    @endif

@endsection

@section('extraJs')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>

    <script>
        function initSwiper(containerSelector, storageKey, delay = 5000) {
            let savedSlide = localStorage.getItem(storageKey) || 0;

            const swiper = new Swiper(containerSelector, {
                loop: false,
                initialSlide: parseInt(savedSlide),
                navigation: {
                    nextEl: containerSelector + ' .swiper-button-next',
                    prevEl: containerSelector + ' .swiper-button-prev',
                },
                pagination: {
                    el: containerSelector + ' .swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: delay, // auto switch
                    disableOnInteraction: false,
                },
            });

            swiper.on('slideChange', function() {
                localStorage.setItem(storageKey, swiper.activeIndex);
            });

            return swiper;
        }

        // Init both swipers with unique keys
        const swiper1 = initSwiper('.swiper.swiper-1', 'activeSlideIndex1', 5000);
        const swiper2 = initSwiper('.swiper.swiper-2', 'activeSlideIndex2', 5000);
    </script>




@endsection
