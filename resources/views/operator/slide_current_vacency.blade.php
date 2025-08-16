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
        </div>
    </header>

    @if (($resData['statusCode'] ?? 400) == 400)
        <!-- Error Message -->
        <div class="max-w-md mx-auto mt-6">
            <div class="flex items-start space-x-3 bg-red-50 border border-red-400 text-red-800 px-4 py-3 rounded-md shadow-sm">
                <svg class="w-5 h-5 mt-1 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
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
                <p class="text-gray-500 text-">Auto-refreshes every 20 seconds</p>
            </div>

            <!-- Swiper 1 -->
            <div class="mb-10">
                <h3 class="text-lg font-semibold text-blue-700 mb-3">Vacancies Group 1</h3>
                <div class="swiper swiper-1">
                    <div class="swiper-wrapper">
                        @php $chunks = collect($resData['currentVacency'] ?? [])->chunk(10); @endphp
                        @foreach ($chunks as $chunk)
                            <div class="swiper-slide">
                                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                                    <table class="min-w-full text-sm">
                                        <thead class="bg-blue-800 text-white text-xs uppercase">
                                            <tr>
                                                <th class="px-4 py-2 text-left">School Code</th>
                                                <th class="px-4 py-2 text-left">School Name</th>
                                                <th class="px-4 py-2 text-left">District</th>
                                                <th class="px-4 py-2 text-left">Post</th>
                                                <th class="px-4 py-2 text-left">Medium</th>
                                                <th class="px-4 py-2 text-left">Category</th>
                                                <th class="px-4 py-2 text-center">Vacancy</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($chunk as $row)
                                                <tr class="hover:bg-blue-50 transition">
                                                    <td class="px-4 py-2">{{ $row->school_vacency->schoolCode ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->schoolName ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->district ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->allpost->name ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->medium ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->vacencyCategory ?? '' }}</td>
                                                    <td class="px-4 py-2 text-center font-semibold text-blue-700">
                                                        {{ $row->remaingVacency ?? 0 }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- <div class="swiper-button-prev text-blue-700"></div> -->
                    <!-- <div class="swiper-button-next text-blue-700"></div> -->
                </div>
            </div>

            <!-- Swiper 2 -->
            <div>
                <h3 class="text-lg font-semibold text-blue-700 mb-3">Vacancies Group 2</h3>
                <div class="swiper swiper-2">
                    <div class="swiper-wrapper">
                        @php $chunks = collect($resData['currentVacency2'] ?? [])->chunk(10); @endphp
                        @foreach ($chunks as $chunk)
                            <div class="swiper-slide">
                                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                                    <table class="min-w-full text-sm">
                                        <thead class="bg-blue-800 text-white text-xs uppercase">
                                            <tr>
                                                <th class="px-4 py-2 text-left">School Code</th>
                                                <th class="px-4 py-2 text-left">School Name</th>
                                                <th class="px-4 py-2 text-left">District</th>
                                                <th class="px-4 py-2 text-left">Post</th>
                                                <th class="px-4 py-2 text-left">Medium</th>
                                                <th class="px-4 py-2 text-left">Category</th>
                                                <th class="px-4 py-2 text-center">Vacancy</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($chunk as $row)
                                                <tr class="hover:bg-blue-50 transition">
                                                    <td class="px-4 py-2">{{ $row->school_vacency->schoolCode ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->schoolName ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->district ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->allpost->name ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->medium ?? '' }}</td>
                                                    <td class="px-4 py-2">{{ $row->school_vacency->vacencyCategory ?? '' }}</td>
                                                    <td class="px-4 py-2 text-center font-semibold text-blue-700">
                                                        {{ $row->remaingVacency ?? 0 }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- <div class="swiper-button-prev text-blue-700"></div> -->
                    <!-- <div class="swiper-button-next text-blue-700"></div> -->
                </div>
            </div>
        </main>
    @endif
@endsection

@section('extraJs')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="module" src="{{ asset('js/Operator/operator.js') }}"></script>

    <script>
        function initSwiper(containerSelector, storageKey, delay = 8000) {
            let savedSlide = localStorage.getItem(storageKey) || 0;

            const swiper = new Swiper(containerSelector, {
                loop: false,
                initialSlide: parseInt(savedSlide),
                navigation: {
                    nextEl: containerSelector + ' .swiper-button-next',
                    prevEl: containerSelector + ' .swiper-button-prev',
                },
                autoplay: {
                    delay: delay,
                    disableOnInteraction: false,
                },
            });

            swiper.on('slideChange', function() {
                localStorage.setItem(storageKey, swiper.activeIndex);
            });

            return swiper;
        }

        const swiper1 = initSwiper('.swiper.swiper-1', 'activeSlideIndex1');
        const swiper2 = initSwiper('.swiper.swiper-2', 'activeSlideIndex2');
    </script>
@endsection
