@extends('layouts.frontend')

@section('title')
    Development
@endsection

@section('assets-header')
    <link href="{{asset('css/development.css')}}" rel="stylesheet" />
@append

@section('content-title')
    Development
@endsection

@section('frontend')

@endsection

@section('assets-footer')
    <script src="{{asset('js/spirit.js')}}"></script>
@endsection

