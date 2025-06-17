<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Operator\CandidateData;
use App\Models\Operator\CurrentVacency;
use App\Models\Operator\SchoolVacency;
use App\Support\Reuseable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
{
    use Reuseable;
    // *** Teacher Index Page ***
    public function index(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];
        try {
            $resData['candidateData'] = CandidateData::all();
            dd($resData['candidateData']);
            $resData['statusCode'] = 200;
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later ";
        }
        dd("OK");
    }

    // *** Search Candidate By Roll Number (POST) ***
    public function searchCandRoll(Request $request)
    {
        // if($request->ajax()){

        $resData = [
            'statusCode' => 400,
            'message' => null
        ];
        $incomming_data = [
            'candRoll' => 'required',
        ];

        try {
            // *** Validate Fields ***
            $validate = $this->validateFields($request, $incomming_data, $request->all());
            if ($validate->fails()) {
                $resData['message'] = "Candidate Roll Number Required !";
            } else {

                if ($this->candByRoll($request->candRoll ?? null)->exists()) {
                    $candDetails = $this->candByRoll($request->candRoll ?? null)->first();
                    if ($candDetails->isAllocated == 1) {
                        $resData['message'] = "Candidate Already Allocated !";
                    } else {
                        $resData['candDetails'] = $candDetails;
                        $resData['statusCode'] = 200;
                    }
                } else {
                    $resData['message'] = "Candidate Roll Number Not Found !";
                }
            }
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later ";
        }

        return response()->json(['resData' => $resData]);
        // }
    }

    // *** Search vacency By Schoool Code ***
    // *** And Allocate School And Maintain Vacency ***
    public function searchVacencyByCode(Request $request)
    {
        // if($request->ajax()){
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];

        $required = '';

        // *** if Allocate Then Required ***
        if (($request->requestType ?? null) == 'allocate') {
            $required = 'required';
        }
        $incomming_data = [
            'candRoll' => $required,
            'schoolCode' => 'required',
            'requestType' => 'required|in:check,allocate'
        ];

        // *** Validate Fields ***
        try {
            $validate = $this->validateFields($request, $incomming_data, $request->all());
            if ($validate->fails()) {
                $resData['message'] = "All Field are required ";
            } else {

                // *** Fetched School Vacency Data ***
                $mainQuery = SchoolVacency::query()->with(['current_vecancy'])
                    ->where('schoolCode', $request->schoolCode ?? 0)
                    ->whereHas('current_vecancy', function ($query) {});
                if ($mainQuery->exists()) {

                    $schoolCodeData = $mainQuery->first();

                    // *** Check Vacency Available ***
                    if (($schoolCodeData->current_vecancy->remaingVacency ?? null) > 0) {

                        // *** If Allocate Process Update Section ***
                        if ($request->requestType == 'allocate') {

                            // *** Fetched Candidate Data ***
                            $candDetails = $this->candByRoll($request->candRoll)->first();

                            // *** Check Candidate Not Allocate ***
                            if ($candDetails && $candDetails->isAllocated != 1) {

                                // *** Calculate Remaing Vacency ***
                                $remaingVacency = $schoolCodeData->current_vecancy->remaingVacency - 1;
                                try {

                                    DB::transaction(function () use ($request, $schoolCodeData, $remaingVacency) {

                                        // *** Update candidate allocation ***
                                        CandidateData::where('rollNumber', $request->candRoll)
                                            ->update([
                                                'allocatedSchoolCode' => $schoolCodeData->id,
                                                'isAllocated' => 1
                                            ]);

                                        // *** Update school vacancy ***
                                        CurrentVacency::where('schoolCode', $schoolCodeData->id)
                                            ->update([
                                                'remaingVacency' => $remaingVacency
                                            ]);
                                    });
                                    $resData['message']="Allocated Successful";
                                    $resData['statusCode']=200;
                                } catch (Exception $err) {
                                    $resData['message'] = "Error in Data Level !";
                                }
                            } else {
                                $resData['message'] = ($candDetails->isAllocated ?? null) == 1 ? "Candidate Already Allocated " : "Candidate Details Not Found !";
                            }
                        } else {
                            $resData['statusCode'] = 200;
                            $resData['schoolCodeData'] = $schoolCodeData;
                            return response()->json(['resData' => $resData]);
                        }
                    } else {
                        $resData['message'] = "Vacency not available !";
                    }
                } else {
                    $resData['message'] = "School Code is not found !";
                }
            }
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later !";
        }

        return response()->json(['resData' => $resData]);
        // }

    }
}
