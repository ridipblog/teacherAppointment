@php
    $data = null;
    $isError = null;
    $allocatedSchool = null;
    $allocatedDetails = null;
    try {
        $data = $viewData['data'] ?? null;
        $allocatedDetails = $data->vacency_details ?? null;
        $allocatedSchool = $allocatedDetails->school_vacency ?? null;
        $isError = $viewData['isError'] ?? true;
    } catch (Exception $err) {
        $isError = true;
    }
@endphp

@extends('layouts.admin_layout')

@section('title', 'Candidate Details ')

{{-- *** Main Content *** --}}
@section('content')

    @if ($isError)
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <p class="">{{ $viewData['message'] ?? 'Some issue execute.' }}</p>
        </div>
    @else
        <!-- Header Design -->
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <h1 class="flex text-3xl font-bold justify-between">
                <span>Candidate Full Details</span>

                <span class="inline-block px-3 py-1 text-sm font-semibold text-gray-500 bg-gray-200 rounded-full">
                    {{ ($data->active ?? null) == 2 ? 'Deactivated' : (($data->active ?? null) == 1 ? 'Actived' : 'No Status') }}
                </span>

            </h1>
        </div>

        <!-- Full Form Start -->
        <div class="space-y-10 bg-white p-6 rounded-xl shadow-lg max-w-4xl mx-auto">

            <!-- Form 1: Candidate Basic -->
            <x-candidate.dataforms.candidate-basic-component :candData="$data">

            </x-candidate.dataforms.candidate-basic-component>

            {{-- *** Form 2: Allocation School Details *** --}}
            @if ($allocatedSchool)
                <x-candidate.dataforms.allocated-school-component :allocateSchool="$allocatedSchool">

                </x-candidate.dataforms.allocated-school-component>
            @endif

            {{-- *** Allocated Details *** --}}
            @if ($allocatedDetails)
                <x-candidate.dataforms.allocated-data-component :allocatedData="$allocatedDetails">

                </x-candidate.dataforms.allocated-data-component>
            @endif

            <!-- Submit Button -->
            @if (($data->active ?? null) == 1 && ($data->isAllocated ?? null) == 1)
                <div class="text-center">
                    <button type="button" value="{{ Crypt::encryptString($data->id ?? null) }}"
                        class="revert-candidate-btn px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Revert Allocated Candidate
                    </button>
                </div>
            @endif

        </div>
    @endif
@endsection

@section('extraJs')

    {{-- *** All Admin Js Code Here *** --}}
    <script type="module" src="{{ asset('js/Admin/admin.js') }}"></script>

@endsection
