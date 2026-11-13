@extends('dashboard.layouts.master')

@section('title', __('Answer Kit'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/answer-kit.css') }}" />
@endsection

@section('backbutton')
    <a href="{{ route('teacher.portal') }}" class="btn btn-back">
        <i class="fa-solid fa-arrow-left"></i> <span>BACK</span>
    </a>
@endsection

@section('content')
    <div class="header-heading">
        <span>Answer Kit</span>
    </div>
    <div class="container item-container mt-5">
        <div class="item-title">
            <span>Mathematics</span>
        </div>
        <div class="boxes mt-5">
            <a href="{{ asset('assets/ebooks/answer-keys/Maths-Star-3-answer-key') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/mathstar-grade-3.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Math Stars 3 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge mathematics">Mathematics</span>
                        <div class="mute-text">
                            <span>PDF • 8 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/Maths-Star-4-answer-key') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/mathstar-grade-4.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Math Stars 4 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge mathematics">Mathematics</span>
                        <div class="mute-text">
                            <span>PDF • 10 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/Maths-Star-5-answer-key') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/mathstar-grade-5.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Math Stars 5 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge mathematics">Mathematics</span>
                        <div class="mute-text">
                            <span>PDF • 11 pages</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="container item-container mt-5">
        <div class="item-title">
            <span>Computer (Digital Discovery)</span>
        </div>
        <div class="boxes mt-5">
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-1') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-1.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 1 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 16 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-2') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-2.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 2 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 17 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-3') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-3.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 3 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 19 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-4') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-4.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 4 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 19 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-5') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-5.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 5 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 18 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-6') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-6.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 6 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 21 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-7') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-7.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 7 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 24 pages</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ asset('assets/ebooks/answer-keys/computer/Grade-8') }}" target="_blank" class="items-box">
                <img height="80px" src="{{ asset('assets/images/books/computer/Grade-8.jpg') }}" alt="book">
                <div class="box-title">
                    <span class="title">Digital Discovery 8 <br> Answer Key</span>
                    <div class="vertical-bottom">
                        <span class="badge computer">Computer</span>
                        <div class="mute-text">
                            <span>PDF • 25 pages</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('script')
@endsection
