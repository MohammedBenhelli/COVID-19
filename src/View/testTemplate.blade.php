{{ $string }}
@if (count($array) === 1)
    un
@elseif (count($array) > 1)
   <p>array superieur a 1</p>
@else
    ptn genial ce test
@endif
@foreach ($array as $user)
    <p>Oui le test {{ $user }}</p>
@endforeach
@isset ($array)
    $array est set
@endisset
@empty ($array)
    $array est empty
@endempty