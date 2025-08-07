<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Operator\CandidateData;
use App\Models\Operator\CurrentVacency;
use App\Models\Operator\SchoolVacency;
use App\Models\Operator\VacencyDetails;
use App\Models\Public\allPost;
use App\Support\Reuseable;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
            $resData['candidateData'] = CandidateData::query()
                ->with(['allpost'])
                ->where('active', 1)
                ->get();
            $resData['statusCode'] = 200;
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later ";
        }

        return view('operator.dashboard', [
            'resData' => $resData
        ]);
    }

    // ***Vacency Districts List ***
    public function cuurentVacencyDistricts(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];
        try {
            $resData['districts'] = SchoolVacency::select('district')
                ->distinct()
                ->get();
            $resData['statusCode'] = 200;
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later ";
        }
        return view(
            'operator.current_vacency_districts',
            compact('resData')
        );
    }
    // *** Current Vacency Page ***
    public function CurrentVacency(Request $request, $districts = null)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];
        try {
            if (!$districts) {
                $resData['message'] = "District Name is required ";
            } else {
                $resData['currentVacency'] = CurrentVacency::query()
                    ->with([
                        'school_vacency' => function ($query) {
                            $query->where('postID', 1)
                                ->where('isEnabled', 1);
                        },
                        'school_vacency.allpost'
                    ])
                    ->whereHas('school_vacency', function ($query) use ($districts) {
                        $query->where('postID', 1)
                            ->where('isEnabled', 1)
                            ->where('district', $districts);
                    })
                    ->get();

                $resData['currentVacency2'] = CurrentVacency::query()
                    ->with([
                        'school_vacency' => function ($query) {
                            $query->where('postID', 2)
                                ->where('isEnabled', 1);
                        },
                        'school_vacency.allpost'
                    ])->whereHas('school_vacency', function ($query) use ($districts) {
                        $query->where('postID', 2)
                            ->where('isEnabled', 1)
                            ->where('district', $districts);
                    })
                    ->get();
                $resData['statusCode'] = 200;
            }
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later ";
        }

        return view('operator.current_vacency', [
            'resData' => $resData
        ]);
    }

    // *** Search Candidate By Roll Number (POST) ***
    public function searchCandRoll(Request $request, $candRoll = null)
    {
        // if($request->ajax()){

        $resData = [
            'statusCode' => 400,
            'message' => null
        ];
        // $incomming_data = [
        //     'candRoll' => 'required',
        // ];

        try {
            // *** Validate Fields ***
            // $validate = $this->validateFields($request, $incomming_data, $request->all());
            // if ($validate->fails()) {
            //     $resData['message'] = "Candidate Roll Number Required !";
            // } else {
            if ($candRoll) {

                $candRoll = Crypt::decryptString($candRoll);
                $mainQuery = CandidateData::query()
                    ->with([
                        'allpost',
                        'vacency_details' => function ($query) {
                            $query->select(
                                'id',
                                'schoolCode'
                            );
                        },
                        'vacency_details.school_vacency' => function ($query) {
                            $query->select(
                                'id',
                            );
                        }
                    ])
                    ->where('rollNumber', $candRoll)
                    ->where('active', 1);
                if ($mainQuery->exists()) {
                    $candDetails = $mainQuery->first();
                    $resData['candDetails'] = $candDetails;
                    $resData['candRoll'] = Crypt::encryptString($candRoll);
                    if ($candDetails->isAllocated == 1) {
                        $resData['message'] = "Appointment Letter Generated";
                    } else {
                        $resData['posts'] = allPost::all();
                        $resData['statusCode'] = 200;
                    }
                } else {
                    $resData['message'] = "Candidate Roll Number Not Found !";
                }
            } else {
                $resData['message'] = "Candidate Roll Required !";
            }

            // }
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later ";
        }
        return view('operator.allocate_vacency', [
            'resData' => $resData
        ]);
        // return response()->json(['resData' => $resData]);
        // }
    }

    // *** Search vacency By Schoool Code ***
    // *** And Allocate School And Maintain Vacency ***
    public function searchVacencyByCode(Request $request)
    {
        if ($request->ajax()) {
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
                'postID' => 'required',
                'requestType' => 'required|in:check,allocate'
            ];

            // *** Validate Fields ***
            try {
                $validate = $this->validateFields($request, $incomming_data, $request->all());
                if ($validate->fails()) {
                    $resData['message'] = "All Field are required ";
                } else {
                    $candRoll = Crypt::decryptString($request->candRoll);

                    // *** Fetched School Vacency Data ***
                    $mainQuery = SchoolVacency::query()->with([
                        'current_vecancy',
                        'vacency_details' => function ($query) {
                            $query->select(
                                'id',
                                'schoolCode',
                                'isAssined'
                            )->where('isAssined', 0)
                                ->limit(1);
                        }
                    ])
                        ->where('schoolCode', $request->schoolCode ?? 0)
                        ->where('postID', $request->postID ?? 0)
                        ->where('isEnabled', 1)
                        ->whereHas('current_vecancy', function ($query) {});
                    // ->whereHas('vacency_details',function($query){
                    //     $query->where('isAssined',0);
                    // });
                    if ($mainQuery->exists()) {


                        $schoolCodeData = $mainQuery->first();

                        // *** Check Vacency Available ***
                        if ((($schoolCodeData->current_vecancy->remaingVacency ?? null) > 0) && (count($schoolCodeData->vacency_details ?? []) != 0)) {

                            // *** If Allocate Process Update Section ***
                            if ($request->requestType == 'allocate') {

                                // *** Fetched Candidate Data ***
                                $candDetails = CandidateData::where('rollNumber', $candRoll)
                                    ->where('post', $request->postID ?? 0)
                                    ->where('active', 1)
                                    ->first();

                                // *** Check Candidate Not Allocate ***
                                if ($candDetails && $candDetails->isAllocated != 1) {
                                    $isProcess = true;
                                    // dd(strtolower($schoolCodeData->medium),strtolower($candDetails->medium));
                                    if ($request->postID == 1) {
                                        $checkProcess = SchoolVacency::query()->with([])
                                            ->where('schoolCode', $request->schoolCode ?? 0)
                                            ->where('postID', $request->postID ?? 0)
                                            ->where('medium', $candDetails->medium)
                                            ->where('isEnabled', 1)
                                            ->where('vacencyCategory', $candDetails->category)->exists();
                                        if (!$checkProcess) {
                                            $isProcess = false;
                                            $resData['message'] = "Medium And Stream does not match !";
                                        }
                                    } elseif ($request->postID == 2) {
                                        $checkProcess = SchoolVacency::query()->with([])
                                            ->where('schoolCode', $request->schoolCode ?? 0)
                                            ->where('postID', $request->postID ?? 0)
                                            ->where('isEnabled', 1)
                                            ->where('vacencyCategory', $candDetails->subject)->exists();
                                        if (!$checkProcess) {
                                            $isProcess = false;
                                            $resData['message'] = "Subject does not match !";
                                        }
                                    } else {
                                        $isProcess = false;
                                        $resData['message'] = "Something Went Wrong!";
                                    }


                                    if ($isProcess) {
                                        // *** Calculate Remaing Vacency ***
                                        $remaingVacency = $schoolCodeData->current_vecancy->remaingVacency - 1;

                                        try {

                                            DB::transaction(function () use ($candRoll, $schoolCodeData, $remaingVacency) {

                                                // *** Update candidate allocation ***
                                                CandidateData::where('rollNumber', $candRoll)
                                                    ->update([
                                                        'allocatedSchoolCode' => $schoolCodeData->vacency_details[0]->id ?? null,
                                                        'isAllocated' => 1,
                                                        'generatedBy' => Auth::user()->id,
                                                        'generatedOn' => Carbon::now(),
                                                    ]);

                                                // *** Update school vacancy ***
                                                CurrentVacency::where('schoolCode', $schoolCodeData->id)
                                                    ->update([
                                                        'remaingVacency' => $remaingVacency
                                                    ]);

                                                // *** Update Vacency Details ***
                                                VacencyDetails::where('id', $schoolCodeData->vacency_details[0]->id ?? null)
                                                    ->update([
                                                        'isAssined' => 1
                                                    ]);
                                            });
                                            $resData['message'] = "Appointment Letter Successfully Generated";
                                            $resData['statusCode'] = 200;
                                        } catch (Exception $err) {
                                            $resData['message'] = "Error in data level";
                                        }
                                    }
                                } else {
                                    $resData['message'] = ($candDetails->isAllocated ?? null) == 1 ? "Appointment Letter Generated " : "Candidate Details Not Found !";
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
        }
    }

    // *** Download Appoinment Letter ***
    public function downloadAppoint(Request $request, $candRoll = null)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];
        $candDetails = null;
        try {
            if ($candRoll) {
                $candRoll = Crypt::decryptString($candRoll);
                $candDetails = CandidateData::query()->with([
                    'vacency_details' => function ($query) {
                        $query->select(
                            'id',
                            'schoolCode',
                            'replcedPersion'
                        );
                    },
                    'vacency_details.school_vacency' => function ($query) {
                        $query->select(
                            'id',
                            'schoolName',
                            'schoolCode',
                            'vacencyCategory',
                            'medium'
                        );
                    }
                ])
                    ->where([
                        ['rollNumber', $candRoll],
                        ['isAllocated', 1],
                        ['active', 1]
                    ])->first();

                if (($candDetails->post ?? 0) == 1) {
                    $pdf = Pdf::loadView('pdf.apl_ug', compact('candDetails'));
                } else {
                    $pdf = Pdf::loadView('pdf.apl_pg', compact('candDetails'));
                }
                $pdf->setPaper('legal', 'portrait');
                return $pdf->download('candidate-' . ($candDetails->rollNumber ?? '00000') . '.pdf');
            } else {
                $resData['message'] = "Candidate roll required !";
            }
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later !";
        }
    }
}
