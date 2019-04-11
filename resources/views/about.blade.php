@extends('layouts.frontend')

@section('title')
    About
@endsection

@section('assets-header')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet" />
@append

@section('content-title')
    About
@endsection

@section('frontend')
    <div id="sidebar" class="col-lg-3 col-md-2 col-sm-12">
        <ul>
            <li class="sidebarItem elize active">Elize</li>
            <li class="sidebarItem nyxart">Abysmal Wonderland</li>
            <li class="sidebarItem attrs">Attributions</li>
        </ul>
    </div>

    <div id="aboutContent" class="col-lg-9 col-md-10 col-xs-12">
        <p id="elize">
            Hello! My name's Elize. I'm a musician with decades of experience and a programmer with a penchant for clever code and beautiful syntax. There’s not much more to say about me here- check out Spirit (hit ` on any page) or check out my Development or Music pages to see what I’m working on!
        </p>

        <p id="nyxart" style="display: none;">
            Welcome to my Abysmal Wonderland (formerly NyxArt)! This is my website where I showcase my music and my programming.<br />
            <br />
            -The Blog page is where I share my thoughts (I swear I’ll get back on that in the future)<br />
            -The Music page is where I showcase my music. The link just sends you to my YouTube channel, but I have plans for a dedicated, custom music page in the future.<br />
            -The Development Page is currently undergoing a major overhaul. It should be back in the very near future.
        </p>

        <p id="attrs" style="display: none;">
            Abysmal Wonderland was created using Laravel!
        </p>
    </div>
@endsection

@section('assets-footer')
    <script src="{{asset('js/about.js')}}"></script>
@endsection

