@extends('auth.layouts.master')

@section('title', __('Register'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('auth-page-class', 'register-page')

@section('css')
    <style>
        .register-page {
            height: auto !important;
            min-height: 100vh;
            padding: 2rem 1rem;
        }
        .register-page .login-card {
            margin-top: 0 !important;
            margin-bottom: 0;
        }
    </style>
@endsection

@php($isStudent = $isStudent ?? false)
@endphp
@section('content')
    <div class="card login-card mt-5">
        <img class="teacher-login-logo" src="{{ asset('assets/images/logos/kinet.png') }}" alt="Kinet">
        <div class="text-center mb-3">
            <div class="icon-circle mb-2">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <h5 class="fw-bold mb-1">Register</h5>
            <p class="text-muted">
                @if ($isStudent)
                    Register your account to access resources
                @else
                    Register your teacher account to access resources
                @endif
            </p>
        </div>

        <form action="{{ route($isStudent ? 'student.register.attempt' : 'teacher.register.attempt') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" placeholder="Enter your phone number" name="phone">
            </div>
           
            <div class="mb-3">
                @php
                $schools = \App\Models\School::all();
                @endphp
                <label class="form-label">Select your School</label>
                <select class="form-control" name="school" required>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($isStudent)
                @php
                    $grades = \App\Models\Grade::all();
                @endphp
                <div class="mb-3">
                <label class="form-label">Select your Grade</label>
                <!-- select your grade with dropdown type -->
               <select class="form-control" name="grade" required>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                
                @endforeach
                </select>
            </div> 
            @endif

            @if ($isStudent)
                <div class="mb-3">
                    <label class="form-label">Roll Number</label>
                    <input type="text" class="form-control" placeholder="Enter your roll number" name="roll_number">
                </div>
            
            @endif

             <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter password" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter same password again" name="confirm-password">
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms" name="terms" checked>
                    <label class="form-check-label" for="terms">Agreed to our <a href="#">Terms and Conditions</a></label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-3">Sign Up</button>
        </form>

        <p class="text-center mt-3 font-14">
            Already have an account? <a href="{{ route('teacher.login') }}" class="text-primary text-decoration-none">Sign In</a>
        </p>
    </div>
@endsection

@section('script')
@endsection
