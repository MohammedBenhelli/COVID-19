@if(Auth::check())
    <?php
    $count = Auth::user()->newThreadsCount();
    ?>
    {{ $count." New Messages" }}
@endif

