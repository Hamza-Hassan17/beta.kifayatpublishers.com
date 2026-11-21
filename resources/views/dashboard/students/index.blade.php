@extends('dashboard.layouts.master')

@section('title', __('Student Portal'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/student-portal.css') }}" />
@endsection

@section('backbutton')
    <a href="{{ route('choose-portal') }}" class="btn btn-back">
        <i class="fa-solid fa-arrow-left"></i> <span>BACK</span>
    </a>
@endsection

@section('content')
    <div class="container">
        <div class="dashboard-header mt-5">
            <h4>Welcome back!</h4>
            <p>Continue your learning journey with our digital resources.</p>
        </div>

        <div class="row student-resource-grid mb-5">
            <div class="col-md-6">
                <a href="{{ route('student.videos') }}" class="student-resource-card">
                    <span class="icon-box"><i class="fa-solid fa-play"></i></span>
                    <span class="student-resource-text">
                        <strong>Video Library</strong>
                        <small>Access educational videos</small>
                    </span>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('student.audios') }}" class="student-resource-card">
                    <span class="icon-box"><i class="fa-solid fa-headphones"></i></span>
                    <span class="student-resource-text">
                        <strong>Audio Books</strong>
                        <small>Listen to audio content</small>
                    </span>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('student.animations') }}" class="student-resource-card">
                    <span class="icon-box"><i class="fa-solid fa-film"></i></span>
                    <span class="student-resource-text">
                        <strong>Digital Discovery Animations</strong>
                        <small>Explore animated lessons</small>
                    </span>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('student.uraan-urdu-series') }}" class="student-resource-card">
                    <span class="icon-box"><i class="fa-solid fa-feather"></i></span>
                    <span class="student-resource-text">
                        <strong>Uraan Urdu Series Worksheets</strong>
                        <small>Learn Urdu with stories and visuals</small>
                    </span>
                </a>
            </div>

            <div class="col-md-6">
                <!-- show toaster that this will be available soon -->
                <a href="#" class="student-resource-card disabled" onclick="showComingSoonToast(event)">
                    <span class="icon-box"><i class="fa-solid fa-book"></i></span>
                    <span class="student-resource-text">
                        <strong>Digital Books</strong>
                        <small>Read digital books</small>
                    </span>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('student.library') }}" class="student-resource-card disabled">
                    <span class="icon-box"><i class="fa-solid fa-book"></i></span>
                    <span class="student-resource-text">
                        <strong>Your Library</strong>
                        <small>Access your digital books here</small>
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function showComingSoonToast(event) {
        if (event) event.preventDefault();
        toastr.info('We are doing some final touches. It will be available soon.');
    }
</script>
@endsection