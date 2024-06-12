@foreach ($tickets as $ticket)
<tr>
    <td>
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
        {{ $ticket->startdate }}

    </td>
    <td>
        {{ $ticket->enddate }}

    </td>

    <td>
        {{ $ticket->created_at->format('Y-m-d h:i A') }}

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



                    <x-ticketstat :ticket="$ticket" />
                

                </ul>
            </div>
     
        



    </td>
</tr>
@endforeach