<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DbViews\AssignCandCountWithUser;
use App\Models\DbViews\AssignedCandDetailsWithUser;
use App\Models\DbViews\ReportRemainingVacancyPg;
use App\Models\DbViews\ReportRemainingVacancyUg;
use App\Models\DbViews\ReportSelectedCandidatePg;
use App\Models\DbViews\ReportSelectedCandidateUg;
use App\Models\Operator\CandidateData;
use App\Models\Operator\CurrentVacency;
use App\Models\Operator\SchoolVacency;
use App\Models\Operator\VacencyDetails;
use App\Models\User;
use App\Support\Reuseable;
use BugLock\rolePermissionModule\Models\UserRoles;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    use Reuseable;

    protected $vacancyCodes;
    protected $replacePersons;
    protected $selectPosts;
    protected $saveSchoolDetails = null;
    protected $schoolCodeId = null;
    protected $vacencyDetailsId = [];
    protected $revertCandId = null;
    protected $userPhone = null;
    protected $userId = null;

    // *** Dashboard View ***
    public function index(Request $request)
    {
        $viewData = [
            'isError' => false,
            'message' => null,
            'counts' => [],
            'reportCards' => null
        ];

        try {

            $reportCardConfig = config('appConfig.reports');

            // *** Assign Candidate Count With User ***
            $viewData['counts']['assignCandCountWithUser'] = AssignCandCountWithUser::count();

            // *** Assigned Candidate Details with user ***
            $viewData['counts']['AssignedCandDetailsWithUser'] = AssignedCandDetailsWithUser::count();

            // *** Report remaining vacency pg ***
            $viewData['counts']['ReportRemainingVacancyPg'] = ReportRemainingVacancyPg::sum('Vacancy');

            // *** Report remaining vacency ug ***
            $viewData['counts']['ReportRemainingVacancyUg'] = ReportRemainingVacancyUg::sum('Vacancy');

            // *** Report selected candidate pg ***
            $viewData['counts']['ReportSelectedCandidatePg'] = ReportSelectedCandidatePg::count();

            // *** Report selected candidate ug ***
            $viewData['counts']['ReportSelectedCandidateUg'] = ReportSelectedCandidateUg::count();

            // *** Report cards config ***
            $viewData['reportCards'] = $reportCardConfig;

            // $columns = Schema::getColumnListing((new ReportSelectedCandidateUg)->getTable());

            $viewData['isError'] = false;
        } catch (Exception $err) {
            $viewData['isError'] = true;
            $viewData['message'] = "Server error please try later !";
        }

        return view('admin.dashboard', compact('viewData'));
    }

    // *** Report Page View ***
    public function reportPage(Request $request, $page = 'assignedCount')
    {

        $viewData = [
            'isError' => false,
            'message' => null,
            'dataHeader' => [],
            'data' => null

        ];

        try {

            $reportConfig = config('appConfig.reports');

            $reportsModels = [
                'assignCandCountWithUser' => assignCandCountWithUser::class,
                'AssignedCandDetailsWithUser' => AssignedCandDetailsWithUser::class,
                'ReportRemainingVacancyPg' => ReportRemainingVacancyPg::class,
                'ReportRemainingVacancyUg' => ReportRemainingVacancyUg::class,
                'ReportSelectedCandidatePg' => ReportSelectedCandidatePg::class,
                'ReportSelectedCandidateUg' => ReportSelectedCandidateUg::class,
            ];

            // *** Get all column name form views ***
            $classObj = $reportsModels[$page];
            if ($classObj && class_exists($classObj)) {

                $mainObj = new $classObj();

                // *** Extract columns name ***
                $columns = Schema::getColumnListing(($mainObj)->getTable());

                $removedColumns = $reportConfig[$page]['removedColumns'];

                $filteredColumns = $columns;
                if (count($removedColumns) != 0) {
                    // *** Extract only required columns ***
                    $filteredColumns = array_values(
                        array_filter(
                            $columns,
                            fn($col)
                            => !in_array($col, $removedColumns)
                        )
                    );
                }

                $viewData['dataHeader'] = $filteredColumns;

                // *** Get all data ***
                if (count($removedColumns) != 0) {
                    $mainObj->select($filteredColumns);
                }
                $data = $mainObj->get();

                $viewData['data'] = $data;
                $viewData['isError'] = false;
            } else {
                $viewData['isError'] = true;
                $viewData['message'] = "Repot card not found ";
            }
        } catch (Exception $err) {
            $viewData['isError'] = true;
            $viewData['message'] = "Server error lease try later !";
        }
        return view('admin.report_page', compact('viewData'));
    }

    // *** School Details View ***
    public function schoolDetailsView(Request $request)
    {
        $viewData = [
            'isError' => false,
            'message' => null,
            'dataHeader' => null,
            'data' => null
        ];

        try {

            // *** Set Headers ***
            $dataHeader = [
                'schoolCode',
                'schoolName',
                'district',
                'medium',
                'vacencyCategory',
            ];

            $tableHeader = $dataHeader;
            $tableHeader[] = 'id';

            // *** Get all school details ***
            $data = SchoolVacency::select($tableHeader)
                ->get();

            $dataHeader[] = 'actionTab';

            $viewData['dataHeader'] = $dataHeader;

            $viewData['data'] = $data;
            $viewData['isError'] = false;
        } catch (Exception $err) {
            $viewData['isError'] = true;
            $viewData['message'] = "Server error please try later !";
        }

        return view('admin.school_details_page', compact('viewData'));
    }

    // *** Add School Vacency Form ***
    public function addSchoolVacency(Request $request, $form = 'add', $schoolCode = null)
    {
        $viewData = [
            'isError' => false,
            'message' => null,
            'data' => null,
            'schoolCode' => $schoolCode,
            'form' => $form
        ];
        try {
            $formConfig = config('appConfig.forms');
            if (!in_array($form, $formConfig)) {
                $viewData['isError'] = true;
                $viewData['message'] = 'Form is not found !';
            } else {
                if ($form != 'add' && $schoolCode) {
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
            $resData['message'] = 'Server error please try later .';
            return response()->json([
                'resData' => $resData
            ]);
        }
    }

    // *** Delete VacencyRow ****
    public function deleteVacencyDetails(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null,
        ];

        try {
            $incomming_data = [
                'schoolCodeId' => 'required',
                'vacencyRowId' => 'required'
            ];

            // *** Validate All Fields ***
            $validate = $this->validateFields($request, $incomming_data, $request->all());
            if ($validate->fails()) {
                $resData['message'] = "All fields are required !";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            $this->schoolCodeId = $request->schoolCodeId;
            $this->vacencyDetailsId = $request->vacencyRowId;

            try {
                DB::beginTransaction();

                // *** Delete vacency detail row ***
                $rowStatus = $this->deleteVacencyRow();
                if (!$rowStatus['status']) {
                    $resData['message'] = $rowStatus['message'] ?? 'Data are not update for an issue .';
                    return response()->json([
                        'resData' => $resData
                    ]);
                }

                // *** Update Actual Vacency on school vacency ***
                if ($this->updateVacency()) {

                    // *** Update reminaing vacency ***
                    if ($this->updateRemaingVacency()) {
                        DB::commit();
                        $resData['message'] = 'Successfully removed vacency details .';
                        $resData['statusCode'] = 200;
                        return response()->json([
                            'resData' => $resData
                        ]);
                    }
                }

                $resData['message'] = 'Error while delete Vacency Details .';
                return response()->json([
                    'resData' => $resData
                ]);
            } catch (Exception $err) {
                DB::rollBack();
                $resData['message'] = 'Error while delete Vacency Details .';
                return response()->json([
                    'resData' => $resData
                ]);
            }
        } catch (Exception $err) {
            $resData['message'] = 'Server error please try later .';
            return response()->json([
                'resData' => $resData
            ]);
        }
    }

    // *** Delete school details ****
    public function deleteSchoolDetails(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null,
        ];

        try {
            $incomming_data = [
                'schoolCodeId' => 'required'
            ];

            // *** Validate All Fields ***
            $validate = $this->validateFields($request, $incomming_data, $request->all());
            if ($validate->fails()) {
                $resData['message'] = "School code is required";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            $this->schoolCodeId = $request->schoolCodeId;

            try {
                DB::beginTransaction();

                // *** Delete school detail ***
                $dataSet = SchoolVacency::find($this->schoolCodeId);
                if ($dataSet) {
                    $dataSet->current_vecancy?->delete();
                    $dataSet->vacency_details()->delete();
                    $dataSet->delete();

                    DB::commit();

                    $resData['message'] = 'Successfully removed vacency details .';
                    $resData['statusCode'] = 200;
                    return response()->json([
                        'resData' => $resData
                    ]);
                }

                $resData['message'] = 'Error while delete School Details .';
                return response()->json([
                    'resData' => $resData
                ]);
            } catch (Exception $err) {
                DB::rollBack();
                $resData['message'] = 'Error while delete School Details .';
                return response()->json([
                    'resData' => $resData
                ]);
            }
        } catch (Exception $err) {
            $resData['message'] = 'Server error please try later .';
            return response()->json([
                'resData' => $resData
            ]);
        }
    }

    // *** Candidate List View ***
    public function candidateList(Request $request)
    {
        $viewData = [
            'isError' => false,
            'message' => null,
            'data' => null
        ];

        try {

            // ** Candidate all data ***
            $data = CandidateData::query()
                ->with(['allpost'])
                ->select(
                    'id',
                    'rollNumber',
                    'post',
                    'name',
                    'isAllocated'
                )
                ->whereHas('allPost')
                ->get();

            $viewData['data'] = $data;
        } catch (Exception $err) {
            $viewData['isError'] = true;
            $viewData['message'] = "Server error please try later !";
        }

        return view('admin.candidate_list_page', compact('viewData'));
    }

    // *** Candidate full details ***
    public function candidateFullDetails(Request $request, $id = null)
    {
        $viewData = [
            'isError' => false,
            'message' => null,
            'data' => null
        ];

        try {
            $this->revertCandId = Crypt::decryptString($id);

            // *** Get Candiadte Details ***
            $data = $this->candiadteDetailsById();
            if ($data) {
                $viewData['data'] = $data;
            } else {
                $viewData['isError'] = true;
                $viewData['message'] = "Candidate details not found ";
            }
        } catch (Exception $err) {
            $viewData['isError'] = true;
            $viewData['message'] = "Server error please try later ";
        }

        return view('admin.candidate_details_page', compact('viewData'));
    }

    // *** Candidate Revert ***
    public function candidateRevert(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];

        try {
            $this->revertCandId = $request->candidateId ?? null;
            $this->revertCandId = Crypt::decryptString($this->revertCandId);
            if ($this->revertCandId) {
                // *** Get candidate revert row ***
                $candRow = $this->candRevertRowById();
                if (!$candRow) {
                    $resData['message'] = "Candidate details not found.";
                    return response()->json([
                        'resData' => $resData
                    ]);
                }
                $this->vacencyDetailsId = $candRow->allocatedSchoolCode ?? null;

                // *** Get vacency revert row ***
                $vacRow = $this->vacRevertRowById();
                if (!$vacRow) {
                    $resData['message'] = "Vacency details not found.";
                    return response()->json([
                        'resData' => $resData
                    ]);
                }
                $this->schoolCodeId = $vacRow->schoolCode ?? null;
                try {

                    // *** Revert candidate allocation ***
                    DB::beginTransaction();

                    // *** Revert current vacency ***
                    $status = $this->revertRemaingVacency($vacRow->school_vacency->actualVacency ?? 0);
                    if (!$status) {
                        throw new Error('Error ');
                    }

                    // *** Revert vacency details ***
                    $status = $this->revertVacRow();
                    if (!$status) {
                        throw new Error('Error ');
                    }

                    // *** Revert candidate details ***
                    $status = $this->revertCandDetails();
                    if (!$status) {
                        throw new Error('Error ');
                    }

                    DB::commit();
                    $resData['message'] = "Candidate revert successful.";
                    $resData['statusCode'] = 200;
                    return response()->json([
                        'resData' => $resData
                    ]);
                } catch (Exception $err) {
                    DB::rollBack();
                    $resData['message'] = "Error execute while revert candidate allocation.";
                    return response()->json([
                        'resData' => $resData
                    ]);
                }
            } else {
                $resData['message'] = "Candidate not required .";
                return response()->json([
                    'resData' => $resData
                ]);
            }
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later !";
            return response()->json([
                'resData' => $resData
            ]);
        }
    }

    // *** Add New User (View) ***
    public function addUser(Request $request)
    {
        $viewData = [
            'isError' => false,
            'message' => null,
            'users' => null
        ];

        try {

            // *** Get All Users ****
            $viewData['users'] = $this->allUsers();

            $viewData['isError'] = false;
        } catch (Exception $err) {
            $viewData['isError'] = true;
            $viewData['message'] = "Server error please dtry later !";
        }

        return view('admin.add_user_page', compact('viewData'));
    }

    // *** Add user post ***
    public function addUserPost(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];

        try {
            $incomming_data = [
                // *** First Form ***
                "name" => 'required',
                "email" => 'required|email',
                "role" => 'required|',
                "password" => 'required',
                "password_confirmation" => 'required'
            ];

            // *** Validate All Fields ***
            $validate = $this->validateFields($request, $incomming_data, $request->all());
            if ($validate->fails()) {
                $resData['message'] = "All fields are required !";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            // *** Check same password or not ***
            if ($request->password !== $request->password_confirmation) {
                $resData['message'] = "Password and confirmation password must be same .";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            $this->userPhone = $request->phone;

            // *** Check user by phone ***
            if ($this->checkUByPhone()) {
                $resData['message'] = "Same phone number already exists .";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            // *** Insert user ***
            try {
                DB::beginTransaction();

                // *** Insert data in user ***
                $saveUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'plainPasswrd' => $request->password
                ]);

                // *** Add role ***
                UserRoles::create([
                    'user_id' => $saveUser->id,
                    'role_id' => $request->role
                ]);

                DB::commit();

                $resData['message'] = "User add sucessfully. ";
                $resData['statusCode'] = 200;
                return response()->json([
                    'resData' => $resData
                ]);
            } catch (Exception $err) {
                DB::rollBack();
                $resData['message'] = "Server error while insert new user.";
                return response()->json([
                    'resData' => $resData
                ]);
            }
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later !";
            return response()->json([
                'resData' => $resData
            ]);
        }
    }

    // *** Deactive user ***
    public function deactiveUser(Request $request)
    {
        $resData = [
            'statusCode' => 400,
            'message' => null
        ];

        try {

            // *** Check user ID ***
            if (!$request->userId ?? null) {
                $resData['message'] = "User is required.";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            $userSttaus = config('appConfig.userStatus');
            $userStatus = array_keys($userSttaus);

            // ** check only valid update type ***
            if (!in_array($request->updateStatus ?? null, $userStatus)) {
                $resData['message'] = "Update type are not valid.";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            $this->userId = Crypt::decryptString($request->userId ?? null);

            // *** Check user eixsts ***
            if (!$this->checkUserId()) {
                $resData['message'] = "User not found !";
                return response()->json([
                    'resData' => $resData
                ]);
            }

            // *** Update Active Status ***
            User::where([
                ['id', $this->userId],
            ])
                ->update([
                    'active' => $request->updateStatus
                ]);

            $resData['message'] = "User status upadted.";
            $resData['statusCode'] = 200;
            return response()->json([
                'resData' => $resData
            ]);
        } catch (Exception $err) {
            $resData['message'] = "Server error please try later !";
            return response()->json([
                'resData' => $resData
            ]);
        }
    }
}
