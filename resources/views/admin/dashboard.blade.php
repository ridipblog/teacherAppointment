@php
    $counts = null;
    $isError = null;
    $reportCards = null;
    try {
        $counts = $viewData['counts'] ?? null;
        $reportCards = $viewData['reportCards'] ?? [];
        $isError = $viewData['isError'] ?? true;
    } catch (Exception $err) {
        $isError = true;
    }
@endphp

@extends('layouts.admin_layout')

@section('title', 'Dashboard')

{{-- *** Main Content *** --}}
@section('content')
    @if ($isError)
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <p class="">{{ $viewData['message'] ?? 'Some issue execute.' }}</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-6 bg-gray-100">

            <!-- Cards -->

            @foreach ($reportCards ?? [] as $key => $value)
                <a href="{{ Route('admin.reportPage', ['page' => $key ?? 'assignCandCountWithUser']) }}"
                    class="bg-white rounded-xl shadow p-4 hover:shadow-md transition border-l-4 border-blue-500">
                    <h2 class="text-base font-medium text-gray-600">{{ $value['title'] ?? '' }}</h2>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $counts[$key] ?? 0 }}</p>
                </a>
            @endforeach

        </div>
    @endif


@endsection

@section('extraJs')

    {{-- *** All Admin Js Code Here *** --}}
    <script type="module" src="{{ asset('js/Admin/admin.js') }}"></script>

@endsection
