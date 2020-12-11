<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
    	$user = User::where('email',$request->email)->first();
    	if($user) {
    		if($user->password == $request->password) {
	    		return response()->json(['Error'=>false, 'msg'=>'Logged In Successfully..','user'=>$user]);
    		} else {
	    		return response()->json(['Error'=>true, 'msg'=>'Password is not matched..']);
    		}
    	} else {
    		return response()->json(['Error'=>true, 'msg'=>'Email doesn`t exist..']);
    	}
    }
    public function registerUser(Request $request)
    {
        $random = Str::random(10);
        $userCheck = User::where('email', $request->email)->get();
        if ($userCheck->count() > 0) {
            return response()->json(['Error'=>true,'msg'=>'Email already registered.']);
        } else {
            $user = new User;
            $user->email = $request->email;
            $user->f_name = $request->f_name;
            $user->l_name = $request->l_name;
            $user->password = $random;
            $user->phone = $request->phone;
            $user->user_type = $request->user_type;
            $user->added_by = 0;
            $user->save();

            \Mail::send('email.register', ['random' => '<p>Your password is </p><h4>'.$user['password'].'</h4>'], function($message)  use ($user)
            {
                $message->to($user['email'], $user['f_name'].' '.$user['l_name'])->subject('Welcome to Contractor!');
            });
            return response()->json(['Error'=>false,'msg'=>'Successfully Added.']);
        }
    }
    public function EditUser(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->email = $request->email;
            $user->f_name = $request->f_name;
            $user->l_name = $request->l_name;
            $user->phone = $request->phone;
            $user->save();
            return response()->json(['Error'=>false,'msg'=>'Successfully Updated.']);
        } else {
            return response()->json(['Error'=>true,'msg'=>'User does not Exist.']); 
        }
    }
    public function UpdatePassword(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->password = $request->password;
            $user->save();
            return response()->json(['Error'=>false,'msg'=>'Successfully Updated.']);
        } else {
            return response()->json(['Error'=>true,'msg'=>'User does not Exist.']); 
        }
    }
    public function getEmployees()
    {
        $user = User::where('user_type', 'employee')->get();
        return response()->json(['employees' => $user]); 
    }
    public function getSubadmins()
    {
        $user = User::where('user_type', 'subadmins')->get();
        return response()->json(['subAdmins' => $user]); 
    }
    public function getUserById($id)
    {
        $user = User::find($id);
        return response()->json(['subAdmins' => $user]); 
    }
     public function delUserById($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['Error' => false, 'msg' => 'Deleted Successfully']); 
    }
}
