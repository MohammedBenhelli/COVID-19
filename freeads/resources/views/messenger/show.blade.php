@extends('layouts.master')

@section('content')
    <div class="col-md-6">
        <h3 style="color: royalblue; margin-bottom: 15px; margin-top: 15px">{{ $thread->subject }}</h3>
        <hr>
        <div id="thread_{{ $thread->id }}">
            @each('messenger.partials.messages', $thread->messages, 'message')
        </div>

        @include('messenger.partials.form-message')
    </div>
@stop
