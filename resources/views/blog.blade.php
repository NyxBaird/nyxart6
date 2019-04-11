@extends('layouts.frontend')


@section('title')
    Blog
@endsection

@section('assets-header')
    <?php
        $sidebarColor1 = '#ddd';
        $sidebarColor2 = '#fff';
    ?>
    <link href="{{ asset('css/hamburger.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet" />
    <style>
        #sidebar {
            background-image: url("{{ asset('/img/vintagepiano.jpg') }}");
        }

        #sidebarContent > ol > li.active {
            background-color: {{$sidebarColor1}};
        }

        #sidebarContent > ol > li > ul > li:hover,
        #sidebarContent > ol > li > ul > li.active {
            background-color: {{$sidebarColor2}};
        }

        #sidebarContent > ol > li:hover {
            background-color: {{$sidebarColor1}};
        }
    </style>
@append

@section('menu')
    <div id="menuBar">
        <button id="menuBurger" class="c-hamburger c-hamburger--htx">
            <span>toggle menu</span>
        </button>
    </div>
@endsection

@section('content-title')
    {{date("m-d-Y", strtotime($posts['current']->published_on))}} - {{$posts['current']->title}}
@endsection

@section('frontend')
    <div id="sidebar">
        <div id="sidebarTransparency"></div>
        <div id="sidebarContent">
            <ol>
                @foreach($posts['sorted'] as $year => $postList)
                    <li class="year">{{$year}}
                        <ul>
                            @foreach($postList as $post)
                                <li class="blogLinkLi">
                                    <a href="{{ route('blog.post', $post->slug) }}">{{$post->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <div id="post">
        {!! $posts['current']->body !!}
    </div>
@endsection

@section('assets-footer')
    <script src="{{asset('js/blog.js')}}"></script>
@endsection

