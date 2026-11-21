<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function studentLogin()
    {
        return redirect()->route('student.portal');
    }

    public function teacherLogin(){
        if (Auth::check()) {
            return redirect()->route('teacher.portal');
        } else {
            return view('auth.teacher-login');
        }
    }

    public function student_login_attempt(Request $request)
    {
        // Validate the form
        $rules = [
            'email' => 'required|email|max:50',
            'password' => 'required',
        ];

        // If captcha is used
        // if (config('captcha.version') !== 'no_captcha') {
        //     $rules['g-recaptcha-response'] = 'required|captcha';
        // } else {
        //     $rules['g-recaptcha-response'] = 'nullable';
        // }

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            $userfind = User::where('email', $request->email)->first();

            if ($userfind) {
                // Check if the password is correct
                if (Hash::check($request->password, $userfind->password)) {
                    // Password matched
                    $remember_me = $request->remember ? true : false;
                    Auth::attempt(['email' => $userfind->email, 'password' => $request->password], $remember_me);

                    if (Auth::check()) {
                        return redirect()->route('student.portal')->with('success', "Login successfully!");
                    } else {
                        return redirect()->back()->withInput($request->all())->with('error', 'Authentication Error');
                    }
                } else {
                    return redirect()->back()->withInput($request->all())->with('error', 'Password is mismatch');
                }
            } else {
                return redirect()->back()->withInput($request->all())->with('error', "Invalid credentials");
            }
        } catch (\Throwable $th) {
            Log::error("Failed to Login:" . $th->getMessage());
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }

    public function teacher_login_attempt(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:50',
            'password' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            if(Auth::attempt(["email" => $request->email, "password" => $request->password])){
                if(Auth::check()){
                    return redirect('teacher.portal')->with('success', 'Welcome, Login successful');
            }}

            else {
                return redirect()->back()->withInput($request->all())->with('error', "Invalid credentials");
            }
        } catch (\Throwable $th) {
            Log::error("Failed to Login:" . $th->getMessage());
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }

    public function studentRegister()
    {
        if (Auth::check()) {
            return redirect()->route('student.portal');
        } else {
            return view('auth.student-register');
        }
    }
    public function student_register_attempt(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'min:11', 'max:11', 'unique:users', 'regex:/^03[0-9]{9}$/'],
            'confirm-password' => ['required', 'same:password'],
            'password' => ['required', 'string', 'min:8'],
            'class' => ['required', 'string', 'min:1', 'max:255'],
            'school' => ['required', 'string', 'min:1', 'max:255'],


        ];
        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()){
            return Redirect::back()->withErrors($validate);
        }
        try{
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::attempt(['email' => $request->email, 'password' => $request->password]);

            if (Auth::check()) {
                DB::commit();
                return redirect()->route('student.portal')->with('success','Your account has been created successfully.');
            }else{
                DB::rollback();
                return redirect()->back()->withInput($request->all())->with('error', 'Authentication Error');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('User registration failed', ['error' => $th->getMessage()]);
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }

    public function teacherRegister()
    {
        if (Auth::check()) {
            return redirect()->route('teacher.portal');
        } else {
            return view('auth.teacher-register');
        }
    }

    public function teacher_register(){
        return view('auth.teacher-register');
    }
    public function teacher_register_attempt(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'min:11', 'max:11', 'unique:users', 'regex:/^03[0-9]{9}$/'],
            'password' => ['required', 'string', 'min:8'],
            'terms' => 'required|string|max:255',
        ];


        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()){
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try{
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::login($user);

            if (Auth::check()) {
                DB::commit();
                return redirect()->route('teacher.portal')->with('success','Your account has been created successfully.');
            }else{
                DB::rollback();
                return redirect()->back()->withInput($request->all())->with('error', 'Authentication Error');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('User registration failed', ['error' => $th->getMessage()]);
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Log::info("Logout Successfully!");
            return Redirect::route('choose-portal')->with('success', 'Logout Successfully!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return Redirect::back()->with('error', "Something went wrong! Please try again later");
        }
    }
}
