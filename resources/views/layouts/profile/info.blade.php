<div class="profile-info">
    <div class="profile-cover">
        <div class="container bg-black overflow-hidden">
            <div class="g_thumb">
                <img alt="{{ $user->name }}" src="{{ $user->cover }}">
            </div>
        </div>
    </div>
    <div class="profile-meta">
        <div class="container">
            <div class="row">
                <div class="col-4 position-relative">
                    <div class="profile-avatar rounded-circle overflow-hidden">
                        <a href="{{ route('User', $user) }}">
                            <img class="img_100" alt="{{ $user->name }}" src="{{ $user->avatar }}">
                        </a>
                    </div>
                </div>

                <div class="col">
                    <profile-action
                        profile_data="{{ $user }}"
                        user_can="@can('edit', $user) {{ true }} @endcan"
                        is_following="{{ current_user() ? current_user()->isFollowing($user) : '' }}"
                    ></profile-action>

                    {{--<div class="profile-action text-right mt-2 d-flex">
                        @can('edit', $user)
                            <a
                                href="{{ $user->path('edit') }}"
                            >
                                @csrf
                                <button
                                    class="btn btn-outline-primary font-weight-bold text-primary br30"
                                >Edit Profile</button>

                            </a>
                        @endcan

                        <x-follow-button :user="$user"></x-follow-button>
                    </div>--}}
                </div>
                @include('layouts.profile.meta')
            </div>
        </div>
    </div>
</div>
