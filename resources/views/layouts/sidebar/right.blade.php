<div class="col-3 sidebar-right">
    <div class="sidebar-right-item pl2- pr-20">
        <div class="box_search">
            <div class="search_form d-flex fs18 text-white alc jcs bg-dark-2 py-1 px-3 br30">
                <svg class="fs22"><use xlink:href="#i-search"></use></svg>
                <input class="w-100 ml20 text-white" placeholder="Tìm kiếm Twitter">
            </div>
        </div>
        <div class="trending-area bg-dark-2 mt20 py-3 br30">
            <h5 class="text-white bbr-dark2 pr-3 ml-3">Maybe You Like</h5>
            @foreach( auth()->user()->following as $user)
                <div class="trending-item hover-bg row alc mx-0 bbs-dark2 py-2 pl-3">
                    <div class="g_thumb circle mr4">
                        <a href="{{ route('profile', $user) }}"><img src="{{ empty($user->avatar) ? 'img/avatar/200.jpg' : $user->avatar }}"></a>
                    </div>
                    <div class="user-meta text-white mr4 ml4 w-auto oh">
                        <h5><a class="fs16 text-white" href="{{ route('profile', $user) }}">{{ empty($user->name) ? '' : $user->name }}</a></h5>
                    </div>
                </div>
            @endforeach
            <a class="ml-3 mt-3 text-primary">Show more</a>
        </div>
    </div>
</div>
