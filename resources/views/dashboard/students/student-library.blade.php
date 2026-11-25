@extends('dashboard.layouts.master')

@section('title', __('My Library'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/student-library.css') }}" />
@endsection

@section('content')
    <div class="header-heading">
        <span>My Library</span>
    </div>

    <div class="container mt-4">
        <div class="library-toolbar mb-4">
            <div>
                <h5>My Books</h5>
                <p>Books you have unlocked with an access code appear here.</p>
            </div>
            <button type="button" class="btn-redeem" data-bs-toggle="modal" data-bs-target="#redeemBookModal">
                <i class="fa-solid fa-key"></i> Redeem Book
            </button>
        </div>

        @if ($books->isNotEmpty())
            <div class="row g-3">
                @foreach ($books as $book)
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <div class="book-card">
                            <div class="book-cover">
                                <i class="fa-solid fa-book"></i>
                            </div>
                            <div class="book-title">{{ $book->title }}</div>
                            <div class="book-meta">By {{ $book->author->name ?? '-' }}</div>
                            <div class="book-meta">ISBN: {{ $book->isbn }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="library-empty">
                <div class="library-empty-icon">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <h5>Your library is empty</h5>
                <p>Redeem an access code to add your first book.</p>
                <button type="button" class="btn-redeem" data-bs-toggle="modal" data-bs-target="#redeemBookModal">
                    <i class="fa-solid fa-key"></i> Redeem Book
                </button>
            </div>
        @endif
    </div>

    <div class="modal fade redeem-modal" id="redeemBookModal" tabindex="-1" aria-labelledby="redeemBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="redeemBookModalLabel">Redeem Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="redeem-icon">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div class="mb-3">
                        <label for="accessCode" class="form-label">Enter Access Code</label>
                        <input type="text" class="form-control" id="accessCode" name="access_code"
                            placeholder="Enter access code" autocomplete="off">
                    </div>
                    <button type="button" class="btn-redeem-now">Redeem Now</button>
                </div>
            </div>
        </div>
    </div>
@endsection
