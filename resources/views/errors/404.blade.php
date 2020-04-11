
@extends('layouts.master')
@section('meta')
    <title>Sorry page not found</title>
    <meta name="description" content="{{ isset($user->story) ? $user->story : 'Tweety | Clone Twitter' }}">
    <meta itemprop="name" content="Tweety">
    <meta itemprop="description" content="{{ isset($user->name) ? $user->name : '' }}">
    <meta itemprop="image" content="{{ isset($user->cover) ? $user->cover : '/img/theme/tweety.jpg' }}">
@endsection
@section('content')
    <div class="col-lg-6 col-md-7 col-sm-9 col-12 bg-dark-2 px-1">
        <div class="site-content">
            <header-bar></header-bar>
            <div class="d-flex p-4 flex-column justify-content-center align-items-center text-light">
                <h3 class="font-weight-bold">Sorry, page not found!!</h3>
                <p>Why you don't search anything else or back to <a href="/">Home</a></p>
            </div>
        </div>
    </div>
@endsection
