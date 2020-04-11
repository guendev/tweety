@extends('layouts.master')
@section('content')
    <div class="col-lg-6 col-md-7 col-sm-9 col-12 bg-dark-2 px-1">
        <div class="site-content">
            <header-bar></header-bar>
            <discovery
                count="{{ \App\Models\User::count() }}"
            ></discovery>
        </div>
    </div>
@endsection
