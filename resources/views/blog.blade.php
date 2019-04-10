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
            background-image: url("{{asset('/img/vintagepiano.jpg')}}");
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
    <script>
        //Once the page is done loading
        $(document).ready(function(){
            //Look for a link containing our current url
            var $target = $('a[href="' + window.location.href + '"]');

            //If that link exists toggle that link open in the sidebar, else toggle the first link in the sidebar
            if ($target.length)
                $target.parent().toggleClass('active')
                    .parent('ul').toggleClass('active')
                    .parent().toggleClass('active');
            else
                $('#sidebarContent > ol > li > ul > li').first().toggleClass('active')
                    .parents('.year').first().click();
        });

        $('.blogLinkLi').click(function(e){
            window.location = $('a', $(e.target)).attr('href');
        });

        $('#frontendContent').click(function(e){
            if ($('#sidebar').position().left === 0 && !$(e.target).parents('#sidebar').length)
                collapseMenu();
        });

        $('#menuBurger').click(function(e) {
            e.preventDefault();

            if(this.classList.contains("active") === true)
                collapseMenu();
            else
                expandMenu();
        });

        $('#sidebarContent .year').on('click', function(){
            if (!$(this).hasClass('active'))
                $('.year.active').first().find('ul').first().toggleClass('active').parent().toggleClass('active');

            $(this).find('ul').first().toggleClass('active').parent().toggleClass('active');
        });

        function collapseMenu(){
            $('#menuBurger').removeClass("active");
            $('#sidebar').animate({left: '-' + ($('#sidebar').width() - 1) + 'px'});
        }

        function expandMenu(){
            $('#menuBurger').addClass("active");
            $('#sidebar').animate({left: '0'});
        }
    </script>
@endsection

