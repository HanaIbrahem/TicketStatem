@php
    $states=['approved', 'opened','reject'];

@endphp
@foreach ($states as $st )

@if ($ticket->state !== $st)
<li>
    <a class="dropdown-item"
        href="{{ route('dashbord.ticket.all.state', ['id' => $ticket->id, 'action' => $st ]) }}">{{$st}}</a>
</li>
@endif

@endforeach