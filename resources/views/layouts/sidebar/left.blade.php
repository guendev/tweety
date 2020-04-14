<div class="col-lg-3 col-md-2 d-md-block d-none sidebar-left">
    <div class="sidebar-left-item position-fixed px-md-3">
        <div class="logo-site">
            <h5 class="">
                <a class="p-3 text-white fs32" href="/home">
                    <svg class=""><use xlink:href="#i-twitter"></use></svg>
                </a>
            </h5>
        </div>
        <div class="menu-sidebar">
            <ul class="list-group text-white nav fs26">
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1" href="{{ route('tweets') }}">
                        <svg><use xlink:href="#i-home"></use></svg>
                        <span class="ml12 fs18 d-lg-inline-block d-none">Trang Chủ</span>
                    </a>
                </li>
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1">
                        <svg><use xlink:href="#i-bell"></use></svg>
                        <span class="ml12 fs18 d-lg-inline-block d-none">Thông Báo</span></a>
                </li>
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1">
                        <svg><use xlink:href="#i-mail"></use></svg>
                        <span class="ml12 fs18 d-lg-inline-block d-none">Tin Nhắn</span></a>
                </li>
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1" href="{{ route('discovery') }}">
                        <svg><use xlink:href="#i-discovery"></use></svg>
                        <span class="ml12 fs18 d-lg-inline-block d-none">Discovery</span></a>
                </li>
                @if(auth()->check())
                    <li class="menu-item my-2">
                        <a
                            class="hover-bg br30_hover px-3 pb-2 pt-1"
                            href="{{ current_user()->path() }}"
                        >
                            <svg><use xlink:href="#i-people"></use></svg>
                            {{--<div class="g_thumb circle">
                                <img alt="{{ current_user()->name }}" src="{{ current_user()->avatar }}">
                            </div>--}}
                            <span class="ml12 fs18 d-lg-inline-block d-none">Hồ Sơ</span>
                        </a>
                    </li>
                    <li class="menu-item my-2">
                        <a href="/auth/logout" class="hover-bg br30_hover px-3 pb-2 pt-1">
                            <svg><use xlink:href="#i-logout"></use></svg>
                            <span class="ml12 fs18 d-lg-inline-block d-none">Đăng Xuất</span>
                        </a>
                        {{--<form id="logOut" action="/auth/logout" method="POST"> @csrf
                            <button type="submit" class="hover-bg br30_hover px-3 pb-2 pt-1">
                                <svg><use xlink:href="#i-logout"></use></svg>
                                <span class="ml12 fs18 d-lg-inline-block d-none">Đăng Xuất</span>
                            </button>
                        </form>--}}
                    </li>
                @endif
            </ul>
        </div>
        <div class="quick-tweet mt-2">
            <a class="btn btn-block btn-primary text-white py-2 br30">Tweet</a>
        </div>
    </div>
</div>
