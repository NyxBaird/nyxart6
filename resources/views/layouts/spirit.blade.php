@section('assets-header')
    <link href="{{asset('css/spirit.css')}}" rel="stylesheet" />
@append

<div class="spirit" id="spiritBG"></div>
<div class="spirit" id="spiritFG">
    <div id="howToClose">Hit ` to close Spirit, type "help" or "?" for help.</div>

    <div id="spiritContent"></div>

    <div id="spiritInput">
        ><input type="text" name="spiritMessage" placeholder="Type a command, hit enter to submit" data-token="{{ csrf_token() }}" data-command-index="0" />
    </div>
</div>

@section('assets-footer')
    <script>
        var user = {!! auth()->user() ? json_encode(auth()->user()) : 0 !!};
    </script>
    <script src="{{asset('js/spirit.js')}}"></script>
@append