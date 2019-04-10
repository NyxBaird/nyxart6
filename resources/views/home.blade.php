@extends('layouts.master')

@section('title')
    Home
@endsection

@section('assets-header')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
    <style>
        #links > ul > li > .selected {
            border-left: 2px solid {{$data['color']}} !important;
        }
    </style>
@append

@section('content')
    <div id="bgTransparency"></div>
    <div id="foreground">
        <h1 id="title">Abysmal Wonderland<span id="version">v{{$data['version']}}</span></h1>
        <div id="links">
            <ul>
                @foreach($links as $link)
                    <li>
                        <a href="{{ $link->url }}" class="{{ $_SERVER['REQUEST_URI'] == $link->url ? 'selected' : '' }}">{{ $link->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="clock" style="color: {{$data['color']}};">
            <span id="time">00:00</span>
            <span id="seconds">:00</span>
        </div>
        </div>
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

@include('layouts.spirit')