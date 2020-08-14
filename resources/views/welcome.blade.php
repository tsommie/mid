@extends('layouts.app')

@section('highlight')
    <!-- Full Page Image Header with Vertically Centered Content -->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <h1 class="font-weight-light">{{ config('app.name', 'X-UUID') }}</h1>
                    <p class="lead">{{ __('A unique individual identification system') }}</p>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- Page Content -->
    <section class="py-5">
        <div class="container">
            <h2 class="font-weight-light">{{ __('Welcome') }}</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat reprehenderit expedita.</p>
        </div>
    </section>
@endsection

@push('stylesheets')
    <style>
        .masthead {
            height: 100vh;
            min-height: 500px;
            background-image: url('https://source.unsplash.com/BtbjCFUvBXs/1920x1080');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endpush
