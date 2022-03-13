<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserApiController extends Controller
{
    public function showUsers($id=null){
        if($id==''){
            $users=User::get();
            return response()->json(['users'=>$users],200);
            // return view('check',compact('users'));

        }else{
            $users=User::find($id);
            return response()->json(['users'=>$users],200);
            // return view('check',compact('users'));
        }
    }

    public function addUsers(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            // return $data;
            // For Validation

            $req=[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',
            ];

            $cMessage=[
                'name.required'=>'Name is Required',
                'email.required'=>'Email is Required',
                'email.email'=>'Email must be valid Email',
                'password.required'=>'Password is Required',
            ];

           $validator=FacadesValidator::make($data,$req, $cMessage);
           if($validator->fails()){
            return response()->json($validator->errors(),422);
           }

            $users=new User();

            $users->name= $data['name'];
            $users->email= $data['email'];
            $users->password= bcrypt($data['password']);
            $users->save();

            $msg="Data Added Successfully";
            return response()->json(['msg'=>$msg],201);
        }

    }

    public function multiAddUsers(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            // return $data;
            // For Validation

            $req=[
                'users.*.name'=>'required',
                'users.*.email'=>'required|email|unique:users',
                'users.*.password'=>'required',
            ];

            $cMessage=[
                'users.*.name.required'=>'Name is Required',
                'users.*.email.required'=>'Email is Required',
                'users.*.email.email'=>'Email must be valid Email',
                'users.*.password.required'=>'Password is Required',
            ];

           $validator=FacadesValidator::make($data,$req, $cMessage);
           if($validator->fails()){
                return response()->json($validator->errors(),422);
           }

           foreach($data['users'] as $usersdata){
            $users=new User();

            $users->name= $usersdata['name'];
            $users->email= $usersdata['email'];
            $users->password= bcrypt($usersdata['password']);
            $users->save();

            $msg="Data Added Successfully";

           }
           return response()->json(['msg'=>$msg],201);
        }
    }
}
