
@extends('layouts.master')
@section('content')
<div class="col-lg-6 col-md-7 col-sm-9 col-12 bg-dark-2 px-1">
    <div class="site-content">
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


