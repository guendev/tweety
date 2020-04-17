<div class="col-lg-3 col-md-3 col-sm-3 col-12 sidebar-right">
    <div class="sidebar-right-item position-fixed pr-20">
        <your-friends></your-friends>
        {{--<div class="trending-area bg-dark-2 mt20 py-3 br30">
            <h5 class="text-white bbr-dark2 pr-3 ml-3">Your Friends</h5>
            @if(auth()->check())
                @foreach( auth()->user()->following as $user)
                    <div class="trending-item hover-bg row alc mx-0 bbs-dark2 py-2 pl-3">
                        <div class="g_thumb circle mr4">
                            <a href="{{ route('UserController', $user) }}"><img src="{{ empty($user->avatar) ? 'img/avatar/200.jpg' : $user->avatar }}"></a>
                        </div>
                        <div class="user-meta text-white mr4 ml4 w-auto oh d-lg-inline-block d-none">
                            <h5><a class="fs16 text-white" href="{{ route('UserController', $user) }}">{{ empty($user->name) ? '' : $user->name }}</a></h5>
                        </div>
                    </div>
                @endforeach
            @endif
            <a class="ml-3 mt-3 text-primary">Show more</a>
        </div>--}}
    </div>
</div>
