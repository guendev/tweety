
@extends('layouts.master')
@section('meta')
    <title>{{ isset($user->name) ? $user->name : 'Tweety | Clone Twitter' }}</title>
    <meta name="description" content="{{ isset($user->story) ? $user->story : 'Tweety | Clone Twitter' }}">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="Tweety">
    <meta itemprop="description" content="{{ $user->name }}">
    <meta itemprop="image" content="{{ isset($user->cover) ? $user->cover : '/img/theme/tweety.jpg' }}">
@endsection
@section('content')
    <div class="col-lg-6 col-md-7 col-sm-9 col-12 bg-dark-2 px-1">
        <div class="site-content">
         {{--@include('layouts.profile.info')--}}
            <header-bar></header-bar>
            <profile-detail
                user="{{ json_encode($user) }}"
                follow="{{ json_encode($follow_data) }}"
                user_can="@can('edit', $user) {{ true }} @endcan"
                is_following="{{ current_user() ? current_user()->isFollowing($user) : '' }}"
                count="{{ $user->tweets()->count() }}"
            ></profile-detail>
            <tweet-detail
                tweets="{{ json_encode($profile_data) }}"
                user="{{ $user }}"
            ></tweet-detail>
        </div>
    </div>
@endsection
<script>
</script>
