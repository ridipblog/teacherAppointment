<?php

namespace App\Support;

use App\Models\Operator\CandidateData;
use App\Models\Operator\SchoolVacency;
use Illuminate\Support\Facades\Validator;

trait Reuseable
{

    // ---------------- validate incomming data  ---------------
    public static function validateFields($request, $request_field, $validate_type)
    {
        // App::setLocale(session::get('locale'));
        $error_message = [
            // 'required' => ':attribute '.__('validation_message.dynamic_validate_errors.required'),
            'required' => ':attribute is required field !',
            'integer' => ':attribute is only number format !',
            'regex' => 'phone number must be 10 digit ',
            'max' => ':attribute  size only 2 megabytes',
            'mimes' => ':attribute file type is not valid ',
            'email' => 'Please enter a valid email',
            'confirmed' => ':attribute is does not match with confirmation',
            'date' => ':attribute is date only ',
            'unique' => ':attribute is already exists ',
            'array' => ':attribute is array type',
            'required_if' => ':attribute is require field !',
            'exists' => ':attribute is not found in database !',
            'phone.exists' => 'phone number is not exists ,please register your number'
        ];
        $validate = Validator::make(
            $validate_type,
            $request_field,
            $error_message
        );
        return $validate;
    }


    // *** Check Candidate By Roll NUmber ***
    public function candByRoll($candRoll)
    {
        $mainQuery = CandidateData::query()
            ->where('rollNumber', $candRoll);
        return $mainQuery;
    }

    // *** School Details Columns ***
    public function schoolDetailsCoulmns($request)
    {
        return [
            'schoolCode' => $request->schoolCode,
            'schoolName' => $request->schoolName,
            'district' => $request->district,
            'medium' => $request->medium,
            'vacencyCategory' => $request->subject,
            'actualVacency' => $request->actualVacancy,
            'postID' => $request->postName
        ];
    }

    // *** Check School Code and Post are unique ***
    public function uniqueSCodePost($request)
    {
        return SchoolVacency::where([
            'schoolCode' => $request->schoolCode,
            'postID' => $request->postName
        ]);
    }

    // *** Get Actual Vacency ***
    public function getActualVacency()
    {
        return SchoolVacency::query()
            ->with([
                'current_vecancy'
            ])
            ->select('actualVacency', 'id')
            ->where([
                'id' => $this->schoolCodeId
            ])
            ->whereHas('current_vecancy')
            ->first();
    }

    // *** Add Vacency Details ***
    public function processVacencyDetails()
    {
        $arrangedVDetails = [];
        $postConfig = config('appConfig.posts');

        foreach ($this->vacancyCodes ?? [] as $index => $vCode) {
            $arrangedVDetails[] = [
                'schoolCode' => $this->saveSchoolDetails->id ?? null,
                'post' => $postConfig[$this->selectPosts],
                'vacencyCode' => $vCode,
                'replcedPersion' => $this->replacePersons[$index] ?? null
            ];
        }
        return $arrangedVDetails;
    }

    // *** Process data to Update vacency details ***
    public function processUpdateVacencyDetails()
    {
        $postConfig = config('appConfig.posts');

        $newVacencyDetails = [];
        $bindings = [];

        $vacancyCodeCase = "CASE vacency_details.id";
        $replacePersonCase = "CASE vacency_details.id";

        foreach ($this->vacancyCodes ?? [] as $index => $vCode) {
            if ($this->vacencyDetailsId[$index] ?? null) {
                $vacancyCodeCase .= " WHEN ? THEN ?";
                $bindings[] = $this->vacencyDetailsId[$index];
                $bindings[] = $vCode;
            } else {
                $newVacencyDetails[] = [
                    'schoolCode' => $this->schoolCodeId,
                    'post' => $postConfig[$this->selectPosts],
                    'vacencyCode' => $vCode,
                    'replcedPersion' => $this->replacePersons[$index] ?? null
                ];
            }
        }
        foreach ($this->replacePersons ?? [] as $index => $person) {
            if ($this->vacencyDetailsId[$index] ?? null) {
                $replacePersonCase .= " WHEN ? THEN ?";
                $bindings[] = $this->vacencyDetailsId[$index];
                $bindings[] = $person;
            }
        }

        $vacancyCodeCase .= " END";
        $replacePersonCase .= " END";

        // *** Vacency Details PLaceholders ***
        $inPlaceholders = implode(',', array_fill(0, count($this->vacencyDetailsId ?? []), '?'));
        $bindings = array_merge($bindings, $this->vacencyDetailsId ?? []);

        // *** Apply School Code ID ***
        $bindings[] = $this->schoolCodeId;

        // Final query with JOIN
        $sql = "
            UPDATE vacency_details
            JOIN school_vacency ON school_vacency.id = vacency_details.schoolCode
            SET
                vacency_details.vacencyCode = {$vacancyCodeCase},
                vacency_details.replcedPersion = {$replacePersonCase}
            WHERE
                vacency_details.id IN ({$inPlaceholders})
                AND school_vacency.id = ?
        ";

        return [
            'sql' => $sql,
            'bindings' => $bindings,
            'newVacencyDetails' => $newVacencyDetails
        ];
    }
}
