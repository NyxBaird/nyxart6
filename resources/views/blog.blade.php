@extends('layouts.frontend')

@section('title')
    Blog
@endsection

@section('assets-header')
    <style>
        #sidebar {
            position: fixed;
            font-size: 25px;
            background-color: #fff;
            height: calc(100% - 35px);
            width: 33%;
            left: -33%;
            border-right: 2px solid black;
            overflow-y: scroll;
            z-index: 5000;
        }

        #sidebar::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #sidebar::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        #sidebar::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #444;
        }

        @media only screen and (max-device-width: 480px) {
            #sidebar {
                width: 100%;
            }
        }

        ol, ul, li {
            list-style: none;
        }

        #sidebar > ol {
            padding-top: 30px;
            padding-left: 0;
        }

        #menuBar {
            position: fixed;
            left: 0;
            width: 100%;
            z-index: 5001;
        }

        .year {
            padding-left: 15px;
        }

        .year:hover {
            cursor: pointer;
        }

        .year ul {
            display: none;
            font-size: 14px;
        }

        .year ul.active {
            display: initial;
        }

        .year ul li {
            padding: 0 0 5px 15px;
            font-family: 'Open Sans', sans-serif;
        }

        .c-hamburger {
            display: block;
            position: relative;
            overflow: hidden;
            margin: 0;
            padding: 0;
            width: 30px;
            height: 30px;
            font-size: 0;
            text-indent: -9999px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            box-shadow: none;
            border-radius: 0;
            border: none;
            cursor: pointer;
            -webkit-transition: background 0.3s;
            transition: background 0.3s;
        }

        .c-hamburger:focus {
            outline: none;
        }

        .c-hamburger span {
            display: block;
            position: absolute;
            top: 13px;
            left: 5px;
            right: 5px;
            height: 2px;
            background: black;
        }

        .c-hamburger span::before,
        .c-hamburger span::after {
            position: absolute;
            display: block;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: black;
            content: "";
        }

        .c-hamburger span::before {
            top: -7px;
        }

        .c-hamburger span::after {
            bottom: -7px;
        }

        .c-hamburger--htx {
            background-color: #fff;
        }

        .c-hamburger--htx span {
            -webkit-transition: background 0s 0.3s;
            transition: background 0s 0.3s;
        }

        .c-hamburger--htx span::before,
        .c-hamburger--htx span::after {
            -webkit-transition-duration: 0.3s, 0.3s;
            transition-duration: 0.3s, 0.3s;
            -webkit-transition-delay: 0.3s, 0s;
            transition-delay: 0.3s, 0s;
        }

        .c-hamburger--htx span::before {
            -webkit-transition-property: top, -webkit-transform;
            transition-property: top, transform;
        }

        .c-hamburger--htx span::after {
            -webkit-transition-property: bottom, -webkit-transform;
            transition-property: bottom, transform;
        }

        .c-hamburger--htx.active {
            transition: background-color 0.5s ease,
                        color 0.5s ease;
            background-color: red;
            color: #fff;
        }

        .c-hamburger--htx.active span {
            background: none;
        }

        .c-hamburger--htx.active span::before {
            top: 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .c-hamburger--htx.active span::after {
            bottom: 0;
            -webkit-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .c-hamburger--htx.active span::before,
        .c-hamburger--htx.active span::after {
            -webkit-transition-delay: 0s, 0.3s;
            transition-delay: 0s, 0.3s;
        }

        #post {
            font-family: 'Open Sans', sans-serif;
            position: absolute;
            text-indent: 25px;
            top: 0;
            left: 0;
            width: 100%;
            padding: 50px 10% 50px 10%;
        }
    </style>
@append

@section('content-title')
    {{date("m-d-Y", strtotime($posts['current']->published_on))}} - {{$posts['current']->title}}
@endsection

@section('frontend')
    <div id="sidebar">
        <div id="menuBar">
            <button id="menuBurger" class="c-hamburger c-hamburger--htx">
                <span>toggle menu</span>
            </button>
        </div>
        <ol>
            @foreach($posts['sorted'] as $year => $postList)
                <li class="year">{{$year}}
                    <ul>
                        @foreach($postList as $post)
                            <li>
                                - <a href="{{ route('blog.post', $post->slug) }}">{{$post->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ol>
    </div>

    <div id="post">
        {!! $posts['current']->body !!}
    </div>
@endsection

@section('assets-footer')
    <script>
        $('#menuBurger').on("click", function(e) {
            e.preventDefault();

            if(this.classList.contains("active") === true)
                collapseMenu(this);
            else
                expandMenu(this);
        });

        $('#sidebar .year').on('click', function(){
            $(this).find('ul').first().toggleClass('active');
        });

        function collapseMenu(e){
            e.classList.remove("active");
            $('#sidebar').animate({left: '-33%'});
        }

        function expandMenu(e){
            e.classList.add("active");
            $('#sidebar').animate({left: '0'});
        }
    </script>
@endsection

