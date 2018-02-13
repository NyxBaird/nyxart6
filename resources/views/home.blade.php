@extends('layouts.master')

@section('title')
    Home
@endsection

@section('assets-header')
    <style>
        #title {
            position: fixed;
            left: 0;
            width: 100%;
            text-align: left;
            font-size: 18vw;
            margin: 0;
        }

        #clock {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 320px;
            height: 100px;
            margin: 0;
        }

        #time {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 250px;
            height: 100%;
            font-size: 100px;
            text-align: right;
            margin-top: -20px;
        }

        #seconds {
            font-size: 40px;
            left: 251px;
            bottom: 0px;
            width: 50px;
            position: absolute;
            text-align: left;
            margin-bottom: -2px;
        }

        #links {
            position: absolute;
            top: 50%;
            width: 100%;
            text-align: center;
            transform: translateY(-50%);
        }

        #links > ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #links > ul > li {
            margin: 0;
        }

        @media only screen and (min-device-width: 480px) {
            #title {
                top: -15px;
            }

            #links > ul > li {
                display: inline;
                margin: 20px;
            }
        }

        @media only screen and (max-device-width: 480px) {
            #links > ul {
                margin: 0;
                padding: 0;
            }

            #links > ul > li {
                margin: 0;
                padding: 0;
            }
        }

        #links > ul > li > a {
            font-size: 30px;
            padding-left: 5px;
            margin-left: -5px;
            color: black;
        }

        #links > ul > li > a {
            text-decoration: none;
        }

        #links > ul > li > a:hover {
            border-left: 1px solid #ccc;
        }

        #links > ul > li > .selected {
            border-left: 2px solid {{$data['color']}} !important;
        }

        #version {
            font-size: 10px;
        }
    </style>
@endsection

@section('content')
    <h1 id="title">NYX ART<span id="version">v{{$data['version']}}</span></h1>
    <div id="links">
        <ul>
            @foreach($links as $link)
                @if($link->title !== 'Development')
                    <li>
                        <a href="{{ $link->url }}" class="{{ $_SERVER['REQUEST_URI'] == $link->url ? 'selected' : '' }}">{{ $link->title }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div id="clock" style="color: {{$data['color']}};">
        <span id="time">00:00</span>
        <span id="seconds">:00</span>
    </div>

    @include('layouts.spirit')
@endsection

@section('assets-footer')
    <script>
        $(document).ready(function(){
             setInterval(function(){
                 var now = new Date(),
                     hours = now.getHours(),
                     minutes = now.getMinutes(),
                     seconds = now.getSeconds(),

                     $time = $('#time'),
                     $seconds = $('#seconds');

                 $time.html(('0' + hours).substr(-2) + ':' + ('0' + minutes).substr(-2));
                 $seconds.html(':' + ('0' + seconds).substr(-2));
             }, 1000);
        });
    </script>
@endsection

