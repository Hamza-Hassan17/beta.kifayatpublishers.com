@extends('dashboard.layouts.master')

@section('title', __('Answer Kit'))
@section('description', '')
@section('keywords', '')
@section('author', '')
@section('page-class', 'teacher-page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/resource-kit.css') }}" />
@endsection

@section('backbutton')
    <a href="{{ isset($selectedClass) ? route('teacher.answer-kit', ['subject' => request()->route('subject')]) : (isset($selectedSubject) ? route('teacher.answer-kit') : route('teacher.portal')) }}" class="btn btn-back">
        <i class="fa-solid fa-arrow-left"></i> <span>BACK</span>
    </a>
@endsection

@section('content')
    <main class="resource-page container">
        <div class="resource-page-heading">
            <span class="eyebrow">Teacher Answer Kit</span>
            <h1>{{ $selectedClass['name'] ?? ($selectedSubject['name'] ?? 'Answer Keys') }}</h1>
            <p>
                @if (isset($selectedClass))
                    Choose an answer key to open.
                @elseif (isset($selectedSubject))
                    Select a class to view its answer keys.
                @else
                    Choose a subject to find the right answer key.
                @endif
            </p>
        </div>

        @if (!isset($selectedSubject))
            <section class="resource-grid" aria-label="Answer key subjects">
                @foreach ($subjects as $slug => $subject)
                    <a href="{{ route('teacher.answer-kit', ['subject' => $slug]) }}" class="resource-card">
                        <span class="resource-card-icon"><i class="fa-solid {{ $subject['icon'] }}"></i></span>
                        <span class="resource-card-title">{{ $subject['name'] }}</span>
                        <span class="resource-card-description">{{ $subject['description'] }}</span>
                        <span class="resource-card-link">Browse subject <i class="fa-solid fa-arrow-right"></i></span>
                    </a>
                @endforeach
            </section>
        @elseif (!isset($selectedClass))
            <div class="resource-breadcrumb">
                <a href="{{ route('teacher.answer-kit') }}">All subjects</a>
                <i class="fa-solid fa-chevron-right"></i>
                <span>{{ $selectedSubject['name'] }}</span>
            </div>
            <section class="resource-grid resource-grid--classes" aria-label="{{ $selectedSubject['name'] }} classes">
                @foreach ($selectedSubject['classes'] as $slug => $class)
                    <a href="{{ route('teacher.answer-kit', ['subject' => request()->route('subject'), 'class' => $slug]) }}" class="resource-card resource-card--class">
                        <span class="resource-card-icon"><i class="fa-solid fa-layer-group"></i></span>
                        <span class="resource-card-title">{{ $class['name'] }}</span>
                        <span class="resource-card-description">{{ count($class['books']) }} answer key{{ count($class['books']) === 1 ? '' : 's' }} available</span>
                        <span class="resource-card-link">View answer keys <i class="fa-solid fa-arrow-right"></i></span>
                    </a>
                @endforeach
            </section>
        @else
            <div class="resource-breadcrumb">
                <a href="{{ route('teacher.answer-kit') }}">All subjects</a>
                <i class="fa-solid fa-chevron-right"></i>
                <a href="{{ route('teacher.answer-kit', ['subject' => request()->route('subject')]) }}">{{ $selectedSubject['name'] }}</a>
                <i class="fa-solid fa-chevron-right"></i>
                <span>{{ $selectedClass['name'] }}</span>
            </div>
            <section class="book-grid" aria-label="{{ $selectedClass['name'] }} answer keys">
                @foreach ($selectedClass['books'] as $book)
                    <a href="{{ asset($book['url']) }}" target="_blank" rel="noopener" class="book-card">
                        <span class="book-cover">
                            @if ($book['image'])
                                <img src="{{ asset($book['image']) }}" alt="">
                            @else
                                <i class="fa-solid fa-file-circle-check" aria-hidden="true"></i>
                            @endif
                        </span>
                        <span class="book-card-content">
                            <span class="book-card-title">{{ $book['title'] }}</span>
                            <span class="book-card-meta">
                                <span>{{ $selectedSubject['name'] }}</span>
                                <span>PDF · {{ $book['pages'] }} pages</span>
                            </span>
                            <span class="book-card-link">Open answer key <i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                        </span>
                    </a>
                @endforeach
            </section>
        @endif
    </main>
@endsection

@section('script')
@endsection
