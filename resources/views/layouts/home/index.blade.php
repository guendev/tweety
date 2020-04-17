
@extends('layouts.master')
@section('meta')
    <title>Tweety | Clone Twitter</title>
    <meta name="description" content="Tweety | Clone Twitter">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="Tweety">
    <meta itemprop="description" content="Tweety | Clone Twitter">
    <meta itemprop="image" content="/img/theme/tweety.jpg">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://tweety.app">
    <meta property="og:type" content="website">
    <meta property="og:title" content="tweety.app">
    <meta property="og:description" content="Tweety | Clone Twitter">
    <meta property="og:image" content="/img/theme/tweety.jpg">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="tweety.app">
    <meta name="twitter:description" content="Tweety | Clone Twitter">
    <meta name="twitter:image" content="/img/theme/tweety.jpg">
@endsection
@section('content')
<div class="col-lg-6 col-md-7 col-sm-9 col-12 bg-dark-2 px-1">
    <div class="site-content">
        <h1>AAAAAAAAAAAA</h1>
        <header-bar></header-bar>
        @if(auth())
            @include('layouts.home.tweetbox')
        @endif
        {{--@include('layouts.home.newsfeed')--}}
        <new-feeds
            tweets="{{ json_encode($tweets_data) }}"
        ></new-feeds>
    </div>
</div>
@endsection


