@extends('layouts.frontend')

@section('title')
    Blog
@endsection

@section('assets-header')
    <style>
        #sidebar {
            font-size: 25px;
        }

        ol, ul, li {
            list-style: none;
        }

        #sidebar > ol > li {

        }

        a, a:hover {
            text-decoration: none;
            color: black;
        }
    </style>
@append

@section('content-title')
    {{date("m-d-Y", strtotime($posts['current']->published_on))." - \"".$posts['current']->title."\""}}
@endsection

@section('frontend')
    <div id="sidebar">
        <ol>
            @foreach($posts['sorted'] as $year => $posts)
                <li>{{$year}}
                    <ul style="display: none">
                        @foreach($posts as $post)
                            <li>
                                <a href="{{ route('blog.post', ['slug' => $post->slug]) }}">{{$post->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ol>
    </div>
@endsection

@section('assets-footer')
    <script>

    </script>
@endsection

