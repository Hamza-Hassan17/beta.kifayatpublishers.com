@extends('dashboard.layouts.master')

@section('title', __($heading))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/student-audios.css') }}" />
@endsection

@section('backbutton')
    <a href="{{ route('student.portal') }}" class="btn btn-back">
        <i class="fa-solid fa-arrow-left"></i> <span>BACK</span>
    </a>
@endsection

@section('backbutton-spacing', 'mb-0')

@section('content')
    <div class="header-heading">
        <span>{{ $heading }}</span>
    </div>
    <div class="container audio-grade-container">
        <div class="audio-grade-heading">
            <h1>Select your grade</h1>
            <p>Choose a grade to explore the available {{ $resourceLabel }}.</p>
        </div>
        <div class="row audio-grade-grid">
            @foreach ($classes as $class)
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route($routeName, [$routeParameter => $class->slug]) }}" class="audio-grade-card">
                        <span class="audio-grade-label">{{ $class->name }}</span>
                        <span class="audio-grade-link">View {{ $resourceLabel }} <i class="fa-solid fa-arrow-right"></i></span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
@endsection
