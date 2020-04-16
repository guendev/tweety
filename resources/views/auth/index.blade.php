<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    @include('include.favicon')
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>


<div class="content mt-1">
    @include('include.svg')
    <div class="container position-relative" id="app-frontend">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <transition name="headerx">
                                <router-view
                                    class="shadow-lg"
                                ></router-view>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>window.__user_id__ = '{{ current_user() ? current_user()->id : 0 }}'</script>
<script src="/js/app.js"></script>
<script src="/js/template.js"></script>
</body>
</html>
