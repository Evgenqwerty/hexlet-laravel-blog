@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <h1 class="display-4">Welcome to Our Site</h1>
            <p class="lead">This is the home page of our Laravel application.</p>

            <div class="mt-4">
                <a href="{{ route('articles.index') }}" class="btn btn-primary btn-lg me-3">
                    Browse Articles
                </a>
                <br>
                <a href="{{ route('about') }}" class="btn btn-outline-secondary btn-lg">
                    Learn More
                </a>
            </div>
        </div>
    </div>
@endsection
