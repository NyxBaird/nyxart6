@extends('layouts.master')

@section('assets-header')
    <style>
        #header {
            position: fixed;
            font-size: 20px;
            width: 100%;
            height: 30px;
            border-bottom: 1px solid #888;
            background: white;
            z-index: 9999;
        }

        #headerLinks {
            padding: 0;
        }

        #headerLinks a,
        #headerLinks a:hover {
            text-decoration: none;
            color: black;
        }

        #headerLinks > ul > li {
            list-style: none;
            display: inline;
            margin: 0 10px 0 10px;
            padding: 0;
        }

        #headerLinks > ul > li > a:hover {
            border-bottom: 1px solid #ccc;
        }

        #headerLinks > ul > li > .selected {
            border-bottom: 1px solid black;
        }

        #title {
            padding-left: 10px;
        }

        #frontendContent {
            position: absolute;
            top: 30px;
            left: 0;
            width: 100%;
            height: calc(100% - 30px);
        }
    </style>
@append

@section('content')
    <div id="header">
        <div id="title" class="pull-left">@yield('content-title')</div>

        <div id="headerLinks" class="pull-right">
            <ul>
                @foreach($links as $link)
                    {{--This is a temporary fix cuz there's no development page yet--}}
                    @if($link->title !== 'Development')
                        <li>
                            <a href="{{$link->url}}" class="{{$_SERVER['REQUEST_URI'] == $link->url ? 'selected' : ''}}">{{$link->title}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div id="frontendContent">
        @yield('frontend')
    </div>

    <div id="footer"></div>
@endsection

