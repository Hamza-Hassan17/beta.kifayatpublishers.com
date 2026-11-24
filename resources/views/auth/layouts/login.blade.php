@extends('auth.layouts.master')

@section('title', __('Teacher Login'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('auth-page-class', 'teacher-auth-page')

@section('css')
@endsection
@php($isStudent = $isStudent ?? false)
@section('content')
    <div class="card login-card teacher-login-card">
        <img class="teacher-login-logo" src="{{ asset('assets/images/logos/kinet.png') }}" alt="Kinet">
        <div class="text-center mb-3">
            <div class="icon-circle teacher-icon mb-2">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <h5 class="fw-bold mb-1">@if($isStudent) Student @else Teacher @endif Portal</h5>
            <p class="text-muted">Access your educational resources</p>
        </div>

        <form action="{{ route($isStudent ? 'student.login.attempt' : 'teacher.login.attempt') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email">
            </div>
            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div>

            <button type="submit" class="btn teacher-login-button w-100 rounded-3">Sign in</button>
        </form>

        <p class="text-center mt-3 font-14">
            <!-- add conditional routes that if it is student, use student.register route -->
        Don’t have an account? <a href="{{ route($isStudent ? 'student.register' : 'teacher.register') }}" class="teacher-login-link text-decoration-none">@if ($isStudent) Register @else Contact Admin @endif </a>
            
        </p>
    </div>
@endsection

@section('script')
@endsection
