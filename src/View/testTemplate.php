{{ $test[0] }}
@if (count($record) === 1)
    un
@elseif (count($record) > 1)
    superieur
@else
    ptn genial ce test
@endif
@foreach ($test as $user)
    <p>Oui le test {{ $user }}</p>
@endforeach
@isset ($test)
    $test est set
@endisset
@empty ($test)
    $test est empty
@endempty