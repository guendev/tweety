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
<body class="bg-dark-1">


<div class="content mt-1">
    @include('include.svg')
    <div class="container position-relative" id="app-frontend">
        <app-noti></app-noti>
        <div class="row">
            @include('layouts.sidebar.left')
            @yield('content')
            @include('layouts.sidebar.right')
        </div>
    </div>
</div>



<script>window.__user_id__ = '{{ current_user() ? current_user()->id : 0 }}'</script>
<script src="{{ web_asset('/js/app.js') }}"></script>
<script src="{{ web_asset('/js/template.js') }}"></script>
</body>
</html>
