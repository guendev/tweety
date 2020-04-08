
@extends('layouts.master')
@section('content')
    <div class="col-lg-6 col-md-7 col-sm-9 col-12 bg-dark-2 px-1">
        <div class="site-content">
         {{--@include('layouts.profile.info')--}}
            <profile-detail
                user="{{ json_encode($user) }}"
                follow="{{ json_encode($follow_data) }}"
                user_can="@can('edit', $user) {{ true }} @endcan"
                is_following="{{ current_user() ? current_user()->isFollowing($user) : '' }}"
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
