@php
    $isError = null;
    $data = null;
    try {
        $data = $viewData['data'] ?? [];
        $isError = $viewData['isError'] ?? true;
    } catch (Exception $err) {
        $isError = true;
    }
@endphp

@extends('layouts.admin_layout')

@section('title', 'Report Data')

{{-- *** Here Extra Css *** --}}
@section('extraCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

{{-- *** Main Content *** --}}
@section('content')

    @if ($isError)
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <p class="">{{ $viewData['message'] ?? 'Some issue execute.' }}</p>
        </div>
    @else
        <div class="bg-white shadow border p-2 overflow-x-auto w-full">
            <div class="overflow-x-auto">

                {{-- *** Candidate Data Table *** --}}
                <x-admin.candidate-data-table :dataBase="$data"></x-admin.candidate-data-table>
            </div>
        </div>
    @endif


@endsection

@section('extraJs')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    {{-- *** All Admin Js Code Here *** --}}
    <script type="module" src="{{ asset('js/Admin/reportTable.js') }}"></script>
    <script type="module" src="{{ asset('js/Admin/admin.js') }}"></script>

@endsection
