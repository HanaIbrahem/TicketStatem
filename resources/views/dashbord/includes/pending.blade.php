@foreach ($tickets as $ticket)
      <tr>
        <td class="d-flex align-items-center">
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
              {{ $ticket->startdate }}

          </td>
          <td>
              {{ $ticket->enddate }}

          </td>

          <td>
              {{ $ticket->created_at}}

          </td>

          <td>
              <x-ticket :state="$ticket->state" />

          </td>



          <td>

              <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      Actions
                  </button>
                  <ul class="dropdown-menu">

                      <li>
                          <a class="dropdown-item text-primary" id="approve" href="#"
                              data-ticket-id="{{ $ticket->id }}" data-ticket-action="approved">
                              Approve
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item text-danger" href="#"data-ticket-id="{{ $ticket->id }}"
                              data-ticket-action="reject">
                              Reject
                          </a>
                      </li>





                  </ul>
              </div>




          </td>
      </tr>
@endforeach

