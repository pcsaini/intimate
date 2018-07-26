<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function get_register(){
        return view('super.register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:20',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $activation_token = str_random(42);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->token = $activation_token;
        $user->is_active = 1;
        $result = $user->save();

        if (!$result){
            return redirect()->back()->with('error','Problem to Create User')->withInput($request->all());
        }

        if (Auth::attempt(['email' => $email,'password' => $password])){
            return redirect()->route('user.dashboard');
        }else{
            return redirect()->back()->with('error','Problem to Create User')->withInput($request->all());
        }
    }

    public function get_login(){
        return view('super.login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6|max:20',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email,'password' => $password])){
            $user = Auth::user();
            if ($user->is_admin == 1){
                return redirect()->route('super.dashboard');
            }else{
                return redirect()->route('user.dashboard');
            }
        }else{
            return redirect()->back()->with('error','Problem to Create User')->withInput($request->all());
        }

    }

    public function activate_account($token){

    }

    public function get_forgot_password(){
        return view('super.forgot_password');
    }

    public function forgot_password(Request $request){

    }

    public function reset_password($token){
        return view('super.reset_password',['token' => $token]);
    }

    public function update_password(Request $request){

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('get_login');
    }
}
