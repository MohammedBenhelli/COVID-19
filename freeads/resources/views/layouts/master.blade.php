<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Lexx Laravel Messenger with Pusher</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/tailwind.min.css") }}">

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/>
        </svg>
        <a href="http://localhost:3000/home">
            <span class="font-semibold text-xl tracking-tight">Freeads</span>
        </a>
    </div>
    <div class="block lg:hidden">
        <button
            class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="/modify"
               class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                Modify information
            </a>
            <a href="http://localhost:3000/createAds"
               class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                Post an ad
            </a>
            <a href="http://localhost:3000/myAds"
               class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                My Ads
            </a>
            <a href="http://localhost:3000/messages"
               class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
                @include("messenger.unread-count")
            </a>
        </div>
        <form className="mb-4 w-full md:mb-0 md:w-1/4" method="GET" action="http://localhost:3000/searchAds">
            <label class="hidden" htmlFor="search-form">Search</label>
            <input class="text-teal-800 border-2 focus:border-teal-800 p-2 rounded-lg shadow-inner w-full"
                   placeholder="Search" name="search" type="text"/>
            <button class="hidden">Submit</button>
        </form>
        <div>
            <a href="http://localhost:3000/logout" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @if(Auth::check())
    <!-- check if pusher is allowed -->
        @if(config('chatmessenger.use_pusher')) {
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/4.2.1/pusher.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function() {

                    $('form').submit(function(e) {
                        e.preventDefault();

                        var data = $(this).serialize();
                        var url = $(this).attr('action');
                        var method = $(this).attr('method');

                        // clear textarea/ reset form
                        $(this).trigger('reset');

                        $.ajax({
                            method: method,
                            data: data,
                            url: url,
                            success: function(response) {
                                var thread = $('#thread_' + response.message.thread_id);

                                $('body').find(thread).append(response.html);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    });

                    var pusher = new Pusher('{{ config('pusher.connections.main.auth_key') }}', {
                        cluster: '{{ config('pusher.connections.main.options.cluster') }}',
                        encrypted: true
                    });



                    var channel = pusher.subscribe('for_user_{{ Auth::id() }}');

                    channel.bind('new_message', function(data) {
                        // console.log(data);
                        var thread = $('#' + data.div_id);
                        var thread_id = data.thread_id;
                        var thread_plain_text = data.text;
                        var thread_subject = data.thread_subject;


                        if (thread.length) {
                            // thread opened

                            // append message to thread
                            thread.append(data.html);

                            // make sure the thread is set to read
                            $.ajax({
                                url: "/messages/" + thread_id + "/read"
                            });
                        } else {
                            // thread not currently opened

                            // create message
                            var message = '<strong>' + data.sender_name + ': </strong>' + data.text + '<br/><a href="' + data.thread_url + '" class="text-right">View Message</a>';

                            // notify the user
                            toastr.success(thread_subject + '<br/>' + message);

                            // set unread count
                            let url = "{{ route('messages.unread') }}";
                            console.log(url);
                            $.ajax({
                                method: 'GET',
                                url: url,
                                success: function(data) {
                                    console.log('data from fetch: ', data);
                                    var div = $('#unread_messages');

                                    var count = data.msg_count;
                                    if (count == 0) {
                                        $(div).addClass('hidden');
                                    } else {
                                        $(div).text(count).removeClass('hidden');

                                        // if on messages.index - add alert class and update latest message
                                        $('#thread_list_' + thread_id).addClass('alert-info');
                                        $('#thread_list_' + thread_id + '_text').html(thread_plain_text);
                                    }
                                }
                            });
                        }
                    });
                });
            </script>
        @endif
    @endif

</body>
</html>
