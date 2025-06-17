<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Support\Reuseable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthrizzationController extends Controller
{
    use Reuseable;
    // *** Login Page ***
    public function login(Request $request){
        return view('authorization.login');
    }

    // *** Login Post Form ***
    public function loginPost(Request $request){
        // if($request->ajax()){
            $resData=[
                'statusCode'=>400,
                'message'=>null
            ];
            try{

                $incomming_data = [
                    'phone' => 'required|integer|exists:users,phone',
                    'password'=>'required'
                ];

                // *** Validate Fields ***
                $validate=$this->validateFields($request,$incomming_data,$request->all());
                if($validate->fails()){
                    $resData['message']='Credentials not found !';
                }else{
                    $loginData=[
                        'phone'=>$request->phone ?? null,
                        'password'=>$request->password ?? null
                    ];

                    // *** Login Default Guard ****
                    if(Auth::attempt($loginData)){
                        $resData['authPerson']=Auth::user();
                        $resData['statusCode']=200;
                    }else{
                        $resData['message']="Credentials not found !";
                    }
                }

            }catch(Exception $err){
                $resData['message']="Server error please try later ";
            }
            return response()->json([
                'resData'=>$resData
            ]);
        // }
    }
}
