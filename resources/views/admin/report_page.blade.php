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

@section('title', 'Report Data')

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
