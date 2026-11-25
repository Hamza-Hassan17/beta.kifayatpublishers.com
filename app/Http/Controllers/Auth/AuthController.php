<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
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
        if (Auth::guard('student')->check()) {
            return redirect()->route('student.portal');
        }
        return view('auth.student-login');
    }

    public function teacherLogin()
    {
        if (Auth::guard('teacher')->check()) {
            return redirect()->route('teacher.portal');
        }
        return view('auth.teacher-login');
    }

    public function student_login_attempt(Request $request)
    {
        return $this->loginAttempt($request, 'student', 'student.portal');
    }

    public function teacher_login_attempt(Request $request)
    {
        return $this->loginAttempt($request, 'teacher', 'teacher.portal');
    }

    /**
     * Shared login logic. Only accounts from the given guard's own table
     * (student / teacher) can log in, so a student can never obtain a teacher session.
     */
    private function loginAttempt(Request $request, string $guard, string $portalRoute)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->except('password'))->with('error', 'Validation Error!');
        }

        try {
            $remember = $request->boolean('remember');

            if (Auth::guard($guard)->attempt($request->only('email', 'password'), $remember)) {
                $request->session()->regenerate();
                return redirect()->route($portalRoute)->with('success', 'Welcome, Login successful');
            }

            return redirect()->back()->withInput($request->except('password'))->with('error', 'Invalid credentials');
        } catch (\Throwable $th) {
            Log::error("Failed to Login ({$guard}): " . $th->getMessage());
            return redirect()->back()->withInput($request->except('password'))->with('error', 'Something went wrong! Please try again later');
        }
    }

    public function studentRegister()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('student.portal');
        }
        return view('auth.student-register');
    }

    public function student_register_attempt(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:student,email'],
            'phone' => ['required', 'string', 'regex:/^03[0-9]{9}$/'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['required', 'same:password'],
            'school' => ['required', 'exists:school,id'],
            'grade' => ['required', 'exists:grade,id'],
            'roll_number' => ['nullable', 'string', 'max:255'],
        ]);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->except('password', 'confirm-password'));
        }

        try {
            DB::beginTransaction();
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'school_id' => $request->school,
                'grade_id' => $request->grade,
                'roll_number' => $request->roll_number,
            ]);
            DB::commit();

            Auth::guard('student')->login($student);
            $request->session()->regenerate();

            return redirect()->route('student.portal')->with('success', 'Your account has been created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Student registration failed', ['error' => $th->getMessage()]);
            return redirect()->back()->withInput($request->except('password', 'confirm-password'))->with('error', 'Something went wrong! Please try again later');
        }
    }

    public function teacherRegister()
    {
        if (Auth::guard('teacher')->check()) {
            return redirect()->route('teacher.portal');
        }
        return view('auth.teacher-register');
    }

    public function teacher_register()
    {
        return view('auth.teacher-register');
    }

    public function teacher_register_attempt(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teacher,email'],
            'phone' => ['required', 'string', 'regex:/^03[0-9]{9}$/'],
            'password' => ['required', 'string', 'min:8'],
            'school' => ['required', 'exists:school,id'],
            'terms' => 'required|string|max:255',
        ]);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->except('password'))->with('error', 'Validation Error!');
        }

        try {
            DB::beginTransaction();
            $teacher = Teacher::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'school_id' => $request->school,
            ]);
            DB::commit();

            Auth::guard('teacher')->login($teacher);
            $request->session()->regenerate();

            return redirect()->route('teacher.portal')->with('success', 'Your account has been created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Teacher registration failed', ['error' => $th->getMessage()]);
            return redirect()->back()->withInput($request->except('password'))->with('error', 'Something went wrong! Please try again later');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('student')->logout();
            Auth::guard('teacher')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Log::info('Logout Successfully!');
            session(['welcome_seen' => true]);
            return Redirect::route('choose-portal')->with('success', 'Logout Successfully!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return Redirect::back()->with('error', 'Something went wrong! Please try again later');
        }
    }
}
