@php

    $isError = null;
    $data = null;
    $dataHeader = null;
    try {
        $data = $viewData['data'] ?? [];
        $isError = $viewData['isError'] ?? true;
        $dataHeader = $viewData['dataHeader'] ?? [];
    } catch (Exception $err) {
        $isError = true;
    }

@endphp

@extends('layouts.admin_layout')

@section('title', 'School Details')

{{-- *** Here Extra Css *** --}}
@section('extraCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@endsection

{{-- *** Main Content *** --}}
@section('content')

    @if ($isError)
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <p class="">{{ $viewData['message'] ?? 'Some issue execute.' }}</p>
        </div>
    @else
        <!-- Make the table container full width -->

        <a href="#"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New School Details
        </a>


        <div class="bg-white shadow border p-2 overflow-x-auto w-full">
            <div class="overflow-x-auto">

                {{-- *** Report Table *** --}}
                <x-admin.report-table-component :dataHeader="$dataHeader" :dataBase="$data"></x-admin.report-table-component>
            </div>
        </div>
    @endif

@endsection

@section('extraJs')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Buttons Extension -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- File generation support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    {{-- *** All Admin Js Code Here *** --}}
    <script type="module" src="{{ asset('js/Admin/reportTable.js') }}"></script>

@endsection
