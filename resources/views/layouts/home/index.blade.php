
@extends('layouts.master')
@section('content')
<div class="col-6 bg-dark-2 px-1">
    <div class="site-content">
        @if(auth())
            @include('layouts.home.tweetbox')
        @endif
        @include('layouts.home.newsfeed')
    </div>
</div>
@endsection

