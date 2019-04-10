@extends('layouts.master')

@section('assets-header')
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" />
    <style>
        #headerLinks > ul > li > .selected {
            border-bottom: 1px solid {{$color}};
        }
    </style>
@append

@section('content')
    <div id="header">
        @yield('menu')<div id="title" class="pull-left">@yield('content-title')</div>

        <div id="headerLinks" class="pull-right">
            <ul>
                @foreach($links as $link)
                    <li>
                        <a href="{{$link->url}}"
                           class="{{strpos($_SERVER['REQUEST_URI'], $link->url) > -1 && $link->title != 'Home' ? 'selected' : ''}}">
                            {{$link->title}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div id="frontendContent">
        @yield('frontend')
    </div>

    <div id="footer"></div>

    @include('layouts.spirit')
@endsection

