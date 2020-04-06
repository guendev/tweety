
@extends('layouts.master')
@section('content')
    <div class="col-lg-6 col-md-7 col-sm-9 col-12 bg-dark-2 px-1">
        <div class="site-content">
         @include('layouts.profile.info')
            <tweet-detail
                tweets="{{ $user->tweets()->orderBy("created_at", "DESC")->take(5)->get() }}"
                user="{{ $user }}"
            ></tweet-detail>
        </div>
    </div>
@endsection
