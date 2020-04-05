<div class="col-3 sidebar-left">
    <div class="sidebar-left-item pl20 pr20">
        <div class="logo-site">
            <h5 class=""><a class="p-3 text-white fs32" href="/home"><svg class=""><use xlink:href="#i-twitter"></use></svg></a></h5>
        </div>
        <div class="menu-sidebar">
            <ul class="list-group text-white nav fs26">
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1" href="{{ route('tweets') }}"><svg><use xlink:href="#i-home"></use></svg>
                        <span class="ml12 fs20">Trang Chủ</span>
                    </a>
                </li>
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1"><svg><use xlink:href="#i-bell"></use></svg>
                        <span class="ml12 fs20">Thông Báo</span></a>
                </li>
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1"><svg><use xlink:href="#i-mail"></use></svg>
                        <span class="ml12 fs20">Tin Nhắn</span></a>
                </li>
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1"><svg><use xlink:href="#i-home"></use></svg>
                        <span class="ml12 fs20">Dấu Trang</span></a>
                </li>
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1"><svg><use xlink:href="#i-home"></use></svg>
                        <span class="ml12 fs20">Các Danh sách</span></a>
                </li>
                @if(auth()->check())
                    <li class="menu-item my-2">
                        <a
                            class="hover-bg br30_hover px-3 pb-2 pt-1"
                            href="{{ current_user()->path() }}"
                        ><svg><use xlink:href="#i-home"></use></svg>
                            <span class="ml12 fs20">Hồ Sơ</span></a>
                    </li>
                @endif
                <li class="menu-item my-2">
                    <a class="hover-bg br30_hover px-3 pb-2 pt-1"><svg><use xlink:href="#i-home"></use></svg>
                        <span class="ml12 fs20">Thêm</span></a>
                </li>
            </ul>
        </div>
        <div class="quick-tweet mt-2">
            <a class="btn btn-block btn-primary text-white py-2 br30">Tweet</a>
        </div>
    </div>
</div>
