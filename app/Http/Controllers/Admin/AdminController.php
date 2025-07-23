<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operator\SchoolVacency;
use App\Models\Operator\VacencyDetails;
use App\Support\Reuseable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    use Reuseable;

    public function index(Request $request) {}

    // *** Add School Vacency Form ***
    public function addSchoolVacency(Request $request)
    {
        return view('admin.add_school_vacency');
    }

    // *** Add School Vacency Form Process ***
    public function addSchoolVacencyPost(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null,
        ];

        try {
            $incomming_data = [
                // *** First Form ***
                'schoolCode' => 'required',
                'schoolName' => 'required',
                'postName' => 'required',
                'district' => 'required',
                'medium' => 'required',
                'subject' => 'required',
                'actualVacancy' => 'required',
                // *** Second Form ***
                'vacancyCode' => 'required|array',
                'replacePerson' => 'required|array'
            ];

            // *** Validate All Fields ***
            $validate = $this->validateFields($request, $incomming_data, $request->all());
            if ($validate->fails()) {
                $resData['message'] = "All fields are required !";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            // *** Check Actual Vacency And Vacency Details Are Same Length ***
            $replaceCount = count($request->replacePerson ?? []);
            $replacePersonCount = count($request->replacePerson ?? []);
            $actualVacancy = (int) $request->actualVacancy;

            if ($replaceCount !== $actualVacancy || $replacePersonCount !== $actualVacancy) {
                $resData['message'] = 'The number of vacancy detail rows must exactly match the actual vacancy count.';
                return response()->json([
                    'resData' => $resData
                ]);
            }

            // *** Insert School Vacency ***
            try {
                DB::beginTransaction();

                // *** Save School Details ***
                $saveSchool = SchoolVacency::insert([
                    'schoolCode' => $request->schoolCode,
                    'schoolName' => $request->schoolName,
                    'district' => $request->district,
                    'medium' => $request->medium,
                    'vacencyCategory' => $request->subject,
                    'actualVacency' => $request->actualVacancy,
                    'postID' => $request->postName
                ]);

                dd($saveSchool);

                // *** Save Vacency Details ***
                if ($saveSchool) {

                }
            } catch (Exception $err) {
            }
        } catch (Exception $err) {
            $resData['message'] = 'Server error please try later .';
            return response()->json([
                'resData' => $resData
            ]);
        }
    }
}
