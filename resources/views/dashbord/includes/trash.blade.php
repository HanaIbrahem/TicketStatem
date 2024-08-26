@foreach ($tickets as $ticket)
<tr>
    <td>
        <input type="checkbox" name="selected_tickets[]" id="allchecetticket" value="{{ $ticket->id }}" class="me-2 ticketCheckbox">

        {{ $no++ }}
    </td>
    <td>
        {{ $ticket->id }}

    </td>
    <td>
        {{ $ticket->user->name }}

    </td>
    <td>
        {{ $ticket->requestFrom->title }}

    </td>

    <td>
        {{ $ticket->place }}

    </td>
    <td>
        {{ $ticket->deliverytype }}

    </td>
    <td>
        {{ $ticket->issuetype }}

    </td>
    <td>
        {{ $ticket->problemType->title }}

    </td>
    <td>
        {{ $ticket->solution->title }}

    </td>
    <td>
        {{ $ticket->note }}

    </td>
    <td>
        {{ $ticket->reason }}

    </td>
    <td>
        {{ $ticket->responsibility }}

    </td>
    <td>
        {{ $ticket->startdate }}

    </td>
    <td>
        {{ $ticket->enddate }}

    </td>

    <td>
        {{ $ticket->deleted_at->format('Y-m-d h:i A') }}

    </td>

    <td>
        <x-ticket :state="$ticket->state" />

    </td>



    <td>
    
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Actions
                </button>
                <ul class="dropdown-menu">



                
                    <li><a href="{{ route('dashbord.trash.action', ['id' => $ticket->id, 'action' => 'restore' ]) }}" class="dropdown-item" >Restore    </a>  </li>
                    <li><a href="{{ route('dashbord.trash.action', ['id' => $ticket->id, 'action' => 'delete' ]) }}"class="dropdown-item" >Delete    </a>  </li>

                </ul>
            </div>
     
        



    </td>
</tr>
@endforeach