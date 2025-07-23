<?php

namespace App\Support;

use App\Models\Operator\CandidateData;
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
         $mainQuery=CandidateData::query()
            ->where('rollNumber', $candRoll);
            return $mainQuery;
    }
}
