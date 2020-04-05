<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tweety</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div class="content mt12">
    @include('include.svg')
    <div class="container app-frontend">
        <div class="row">
            @include('layouts.sidebar.left')
            @yield('content')
            @include('layouts.sidebar.right')
        </div>
    </div>
</div>
</body>
</html>
