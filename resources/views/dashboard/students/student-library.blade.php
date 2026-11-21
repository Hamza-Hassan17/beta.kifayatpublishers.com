@extends('dashboard.layouts.master')

@section('title', __('Audio Books'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('content')

<h1>This is the Student Library</h1>
<ul>
    @foreach ($books as $book)
        <li>{{ $book['name'] }} is written by {{ $book['author'] }} and its ISBN number is {{ $book['isbn'] }}</li>
    
    @endforeach
</ul>

@endsection