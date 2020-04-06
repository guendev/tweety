
@extends('layouts.master')
@section('content')
<div class="col-6 bg-dark-2 px-1">
    <div class="site-content">
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


