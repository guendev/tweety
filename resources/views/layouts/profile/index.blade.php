
@extends('layouts.master')
@section('content')
    <div class="col-6 bg-dark-2 px-1">
        <div class="site-content">
            @include('layouts.profile.info')
            @include('layouts.profile.newsfeed')
        </div>
    </div>
@endsection
