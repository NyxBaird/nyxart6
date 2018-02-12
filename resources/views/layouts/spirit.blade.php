<style>
    .spirit {
        position: fixed;
        top: 100%;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #spiritBG {
        z-index: 9998;
        background: black;
        opacity: 0.8;
    }

    #spiritFG {
        font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace;
        color: white;
        z-index: 9999;
    }

    #howToClose {
        position: absolute;
        top: 0;
        left: 0;
        height: 15px;

        font-size: 14px;
        font-style: oblique;
    }

    #spiritInput {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;

        font-size: 20px;
    }

    #spiritInput > input {
        width: calc(100% - 15px);
        color: black;
    }

    #spiritContent {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 25px 30px 25px 70px;
        margin: auto;
        font-size: 20px;
    }

    #spiritContent {
        text-indent: -40px;
    }
</style>

<div class="spirit" id="spiritBG"></div>
<div class="spirit" id="spiritFG">
    <div id="howToClose">Hit ` to close Spirit</div>

    <div id="spiritContent"></div>

    <div id="spiritInput">
        ><input type="text" name="spiritMessage" placeholder="Type a command, hit enter to submit" data-token="{{ csrf_token() }}" data-command-index="0" />
    </div>
</div>

@section('assets-footer')
    <script>
        var user = {!! auth()->user() ? json_encode(auth()->user()) : 0 !!}

            //This is a global bool stating if spirit is currently toggled open
        var spiritToggled = false,

            //This is a global array of any keys being held down
            keys = [];


        //When we submit a command, this gets called
        function submitCommand() {
            var command = $('input[name="spiritMessage"]').val(),
                token = $('input[name="spiritMessage"]').data('token'),

                //Grab our message log from our cookies
                messageLog = Cookies.get('messageLog'),

                //This will be our temp object for message log storage
                messageHistory = {},

                //Our current timestamp
                timestamp = Math.round((new Date()).getTime() / 1000),

                //commands in this array will not get saved to our message log for security reasons (that should never be a problem as we won't be sending cookies anywhere, but still...)
                sensitiveCommands = [
                    'login',
                    'register'
                ];

            //If we have cookie data for our message history, decode it
            if (typeof messageLog != 'undefined') {
                messageHistory = JSON.parse(messageLog);
            }

            //If our previously entered command isn't in our sensitive commands list and it's also not a query for help
            if (!sensitiveCommands.includes(command.split(' ')[0]) || command.split(' ')[1] == '?') {

                //Add our last command to our message history for later use
                messageHistory[timestamp] = command;
            }

            //Resave our message history to our cookies and set it to expire in a day
            Cookies.set('messageLog', JSON.stringify(messageHistory), {expires: 1});

            //Render our message and clear our value field
            renderMessage({color: '#d2a5ff'}, command, (user ? user.name : 'Guest'));
            $('input[name="spiritMessage"]').val('');

            //If our command isn't empty, send it off to the server
            if (command) {
                $.ajax({
                    url: '/spiritSubmit',
                    method: 'POST',
                    data: {_token: token, command: command},
                    dataType: 'JSON',
                    success: function (e) {
                        //If we recieve a response, render it
                        renderMessage(e.type, e.response);
                    },
                    error: function (e) {
                        //If the server returns an error for any reason, render this
                        renderMessage({color: '#FF0000', name: 'error'}, 'Spirit\'s lost her marbles! This is most likely due to a network error, please try refreshing the page.', 'System');
                    }
                });
            }
        }

        //This function renders any messages
        function renderMessage(type, response, speaker) {
            //If we didn't determine a specific speaker, assume the speaker's Spirit
            if (typeof speaker == 'undefined') {
                speaker = 'Spirit';
            }

            //These types of responses should have the whole line colored
            colorLineTypes = [
                'error',
                'success'
            ];

            //Determine if the whole line should be colored
            colorLine = type.name !== 'undefined' && colorLineTypes.includes(type.name);

            //Render the message
            $('#spiritContent').append("<p " + (colorLine ? "style='color: " + type.color + "'" : "") + "'><b " + (!colorLine ? "style='color: " + type.color + "'" : "") + ">" + speaker + ":</b> " + response + "</p>");
        }

        //This function will toggle Spirit open or closed
        function toggleSpirit() {
            var position = $('#spiritBG').position(),
                windowHeight = $(document).height();

            //if spirit is active collapse it
            if (!position.top) {
                $('.spirit').each(function(key, element) {
                    $(element).animate({top: windowHeight}, 500)
                });

                //Let our global scope know spirit is closed
                spiritToggled = false;

                //Blur our text input so we don't accidentally type in there while spirit's closed
                $('#spiritInput > input').blur();
            }

            //if spirit is inactive expand it
            if (position.top >= windowHeight) {
                $('.spirit').each(function(key, element) {
                    $(element).animate({top: '0px'}, 500)
                });

                //Let our global scope know spirit is open
                spiritToggled = true;

                //Focus our text input so we don't have to click it
                $('#spiritInput > input').focus();
            }
        }

        /**
         * Event Handlers below this point
         */
        //When we press a key...
        $(document).keydown(function (e) {
            var pressedKey = e.which;

            //If we hit our designated spirit button (`), toggle spirit
            if (pressedKey == 192) {
                toggleSpirit();
                e.preventDefault();
                return;
            }

            //Only run through these if spirit is open
            if (spiritToggled) {

                //WIP fix this functionality! (you'll prolly have to step through the code in chrome)
                //Retrieves our last commands one by one. It is essential that this goes at the top of the spiritToggled commands
                if (pressedKey == 38 || pressedKey == 40) {

                    //Grab our message log
                    var messageLog = Cookies.get('messageLog');

                    //If our message log is not undefined, parse it and begin our command history logic
                    if (typeof messageLog !== 'undefined') {
                        messageLog = $.parseJSON(messageLog);

                        //This is the index of the command we're on
                        var commandIndex = $('input[name="spiritMessage"]').data('command-index');

                        //If we hit the down arrow...
                        if (pressedKey == 40) {

                            //If our commandIndex is 0 we can't go lower so make sure our input field is empty and return
                            if (!commandIndex) {
                                $('input[name="spiritMessage"]').val('');
                                return;
                            }

                            //Subtract one from our command index
                            commandIndex--;
                        }

                        //Add the selected command to our input
                        $('input[name="spiritMessage"]').val(Object.values(messageLog).reverse()[commandIndex])

                        //Increment commandIndex by one and set the new value to our inputs data for future use
                        if (pressedKey == 38) {
                            commandIndex++;

                            //If our command index is greater than or equal to the total number of saved commands set it back to the max
                            if (commandIndex >= Object.values(messageLog).length) {
                                commandIndex = Object.values(messageLog).length - 1;
                            }
                        }

                        //Set our command index to our input for later use
                        $('input[name="spiritMessage"]').data('command-index', commandIndex);
                    }

                //If we pressed any key that wasn't an arrow key, set our command index back to 0
                } else {
                    $('input[name="spiritMessage"]').data('command-index', 0);
                }

                //If spirit is toggled and Enter is hit submit our data
                if (pressedKey == 13) {
                    submitCommand();
                    return;
                }

                /**
                 * Check multiple pressed keys below here
                 **/
            }

            //If our pressed key does not already exist in our keys array, then add it
            if (!keys.includes(pressedKey)) {
                keys.push(pressedKey);
            }
        });

        //If we release a key...
        $(document).keyup(function (e) {
            //clear our key from the keys array
            keys.splice(keys.indexOf(e.which), 1);
        });
    </script>
@append