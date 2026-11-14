@extends('frontend.layouts.master')

@section('title', __('Welcome'))
@section('description', '')
@section('keywords', '')
@section('author', '')
@section('hideBack')

@section('css')
@endsection

@section('content')
    <main class="welcome-screen">
        <img class="welcome-logo" src="{{ asset('assets/images/logos/kinet.png') }}" alt="Kinet">
        <p class="welcome-byline">by Kifayat Publishers</p>
        <p class="welcome-tagline">Where Learning Meets Innovation</p>
        <h1 class="welcome-heading">Your textbook, now <span class="accent">interactive.</span></h1>
        <p class="welcome-subtext">Read, revise, practice and understand your books in one place.</p>
        <a class="btn welcome-button" href="{{ route('choose-portal') }}">Get Started</a>
    </main>
@endsection

@section('script')
@endsection
