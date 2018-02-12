@extends('layouts.frontend')

@section('title')
    About
@endsection

@section('assets-header')
    <style>
        #frontendContent {
            margin: auto;
        }

        #sidebar {
            position: relative;
            float: left;
            border-right: solid 1px #ccc;
            height: 100%;
            padding: 0;
        }

        #sidebar > ul {
            list-style: none;
            padding: 0px;
            font-size: 20px;
        }

        #sidebar > ul > li {
            border-bottom: 1px solid #ccc;
            padding: 10px 30px 10px 30px;
            cursor: pointer;
        }

        #sidebar > ul > li:not(.active):hover {
            background: #eee;
        }

        #aboutContent {
            position: relative;
            float: left;
        }

        #aboutContent > p {
            text-indent: 20px;
            padding-top: 20px;
        }

        .sidebarItem.elize.active {
            background: #ffadad;
        }

        .sidebarItem.nyxart.active {
            background: #fff9ad;
        }

        .sidebarItem.attrs.active {
            background: #adccff;
        }
    </style>
@append

@section('content-title')
    About
@endsection

@section('frontend')
    <div id="sidebar" class="col-lg-3 col-md-2 col-sm-12">
        <ul>
            <li class="sidebarItem elize active">Elize</li>
            <li class="sidebarItem nyxart">NyxArt</li>
            <li class="sidebarItem attrs">Attributions</li>
        </ul>
    </div>

    <div id="aboutContent" class="col-lg-9 col-md-10 col-xs-12">
        <p id="elize">
            About me comming soon!
        </p>

        <p id="nyxart" style="display: none;">
            About NyxArt coming soon!
        </p>

        <p id="attrs" style="display: none;">
            NyxArt favicon made by <a href="http://www.flaticon.com/authors/silviu-runceanu" title="Silviu Runceanu">Silviu Runceanu</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
        </p>
    </div>
@endsection

@section('assets-footer')
    <script>
        $('.sidebarItem').on('click', function(){
            var $target = $(this);

            $('.sidebarItem.active').each(function(key, value){
                $(value).removeClass('active');
            });

            $('#aboutContent > p').each(function(key, value){
                $(value).css('display', 'none');
            });

            if ($target.hasClass('elize')) {
                $('#title').html('About Elize');
                $('#elize').css('display', 'block');
                $target.addClass('active');
            }

            if ($target.hasClass('nyxart')) {
                $('#title').html('About NyxArt');
                $('#nyxart').css('display', 'block');
                $target.addClass('active');
            }

            if ($target.hasClass('attrs')) {
                $('#title').html('Attributions');
                $('#attrs').css('display', 'block');
                $target.addClass('active');
            }
        });
    </script>
@endsection

