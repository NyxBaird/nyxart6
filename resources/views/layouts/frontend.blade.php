@extends('layouts.master')

@section('assets-header')
    <style>
        /*#headerLinks > ul {;*/
        /*}*/

        #header {
            font-size: 20px;
            width: 100%;
            margin: 0 -10px 0 -10px;
            padding: 0 10px 0 10px;
        }

        #headerLinks {
            padding: 0;
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
    </style>
@append

@section('content')
    <div id="header" class="row">
        <div class="text-left col-xs-4">@yield('content-title')</div>
        <div id="headerLinks" class="text-right col-xs-8">
            <ul>
                @foreach($links as $link)
                    <li>
                        <a href="{{$link->url}}" class="{{$_SERVER['REQUEST_URI']==$link->url?'selected':''}}">{{$link->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @yield('frontend')

    <div id="footer"></div>
@endsection

