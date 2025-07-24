<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operator\CurrentVacency;
use App\Models\Operator\SchoolVacency;
use App\Models\Operator\VacencyDetails;
use App\Support\Reuseable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    use Reuseable;

    protected $vacancyCodes;
    protected $replacePersons;
    protected $selectPosts;
    protected $saveSchoolDetails = null;
    protected $schoolCodeId = null;
    protected $vacencyDetailsId = [];

    public function index(Request $request) {}

    // *** Add School Vacency Form ***
    public function addSchoolVacency(Request $request, $form = 'add', $schoolCode = null)
    {
        $viewData = [
            'isError' => false,
            'message' => null,
            'data' => null,
            'schoolCode' => $schoolCode
        ];
        try {
            if ($schoolCode) {
                $schoolCode = Crypt::decryptString($schoolCode);
                $viewData['data'] = SchoolVacency::query()
                    ->with([
                        'vacency_details',
                        'allpost'
                    ])->where('id', $schoolCode)
                    ->first();

                $viewData['isError'] = $viewData['data'] ? false : true;
                $viewData['message'] = $viewData['data'] ? null : 'No data found ';
            }
        } catch (Exception $err) {
            $viewData['isError'] = true;
            $viewData['message'] = 'Server error please try later !';
        }

        return view('admin.add_school_vacency', compact('viewData'));
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
                'replacePerson' => 'required|array',
                'vacancyCode.*' => 'required_if:postName,1',
                'replacePerson.*' => 'required',
                // *** Request Type ***
                'requestType' => 'required',
                // *** If Update Required School Code ID ***
                'schoolCodeId' => 'required_if:requestType,update',
                'vacencyId.*' => 'required_if:requestType,update'
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

            $this->vacancyCodes = $request->vacancyCode;
            $this->replacePersons = $request->replacePerson;
            $this->selectPosts = $request->postName;

            // *** Add New School Details ***
            if ($request->requestType == 'add') {

                // *** Check School Code And Post name ***
                if ($this->uniqueSCodePost($request)->exists()) {
                    $resData['message'] = 'School Code exists with post Name .';
                    return response()->json([
                        'resData' => $resData
                    ]);
                }

                try {
                    DB::beginTransaction();

                    // *** Save School Details ***
                    $this->saveSchoolDetails = SchoolVacency::create($this->schoolDetailsCoulmns($request));

                    if ($this->saveSchoolDetails) {

                        // *** Save Vacency Details ***
                        $vacencyDetails = $this->processVacencyDetails();
                        $saveVacencyDetails = VacencyDetails::insert($vacencyDetails);
                        if ($saveVacencyDetails) {

                            // *** Save Current Vacency  ***
                            $saveCurrentVacency = CurrentVacency::create([
                                'schoolCode' => $this->saveSchoolDetails->id,
                                'remaingVacency' => $actualVacancy
                            ]);
                            if ($saveCurrentVacency) {
                                DB::commit();
                                $resData['message'] = 'Successfully added school details .';
                                $resData['statusCode'] = 200;
                                return response()->json([
                                    'resData' => $resData
                                ]);
                            }
                        }
                    }
                } catch (Exception $err) {
                    DB::rollBack();
                    $resData['message'] = 'Error while add School Details .';
                    return response()->json([
                        'resData' => $resData
                    ]);
                }
            } else if ($request->requestType == 'update') {

                $this->vacencyDetailsId = $request->vacencyId ?? [];
                $this->schoolCodeId = $request->schoolCodeId;

                // *** Check School Code And Post name by SchoolDetails ID ***
                $check = $this->uniqueSCodePost($request)
                    ->whereNot('id', $this->schoolCodeId)
                    ->exists();
                if ($check) {
                    $resData['message'] = 'School Code exists with post Name .';
                    return response()->json([
                        'resData' => $resData
                    ]);
                }

                // *** Get saved actual vecency ***
                $savedActualVacency = $this->getActualVacency();

                // *** Process Vacency Details to update ***
                $processData = $this->processUpdateVacencyDetails();

                $newVacencyies = count($processData['newVacencyDetails'] ?? []);

                $totalVacency = ((int)$savedActualVacency->actualVacency ?? 0) + $newVacencyies;
                if ($totalVacency  != $request->actualVacancy) {
                    $resData['message'] = 'The number of vacancy detail rows must exactly match the actual vacancy count.';
                    return response()->json([
                        'resData' => $resData
                    ]);
                }

                try {
                    DB::beginTransaction();

                    // *** Update School Details ***
                    $updateSchoolDetails = SchoolVacency::where('id', $this->schoolCodeId)
                        ->update($this->schoolDetailsCoulmns($request));

                    // *** Update vacency details ***

                    $afftectedRows = DB::statement($processData['sql'], $processData['bindings']);

                    // *** Add new Vacency if any ***
                    if ($newVacencyies != 0) {
                        $saveVacencyDetails = VacencyDetails::insert($processData['newVacencyDetails']);
                    }

                    // *** Update current vacency ***
                    $saveCurrentVacency = CurrentVacency::where('schoolCode', $this->schoolCodeId)
                        ->update([
                            'remaingVacency' => (int)($savedActualVacency->current_vecancy->remaingVacency ?? 0) + (int)$newVacencyies
                        ]);

                    DB::commit();

                    $resData['statusCode'] = 200;
                    $resData['message'] = 'Sucesfully update school details .';

                    return response()->json([
                        'resData' => $resData
                    ]);
                } catch (Exception $err) {
                    DB::rollBack();
                    $resData['message'] = 'Error while update school details .';
                    return response()->json([
                        'resData' => $resData
                    ]);
                }
            } else {
                $resData['message'] = 'Request type is not valid.';
                return response()->json([
                    'resData' => $resData
                ]);
            }
        } catch (Exception $err) {
            dd($err);
            $resData['message'] = 'Server error please try later .';
            return response()->json([
                'resData' => $resData
            ]);
        }
    }
}
