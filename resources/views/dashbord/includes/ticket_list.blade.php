 


          @foreach ($tickets as $ticket)
              <tr>
                  <td class="d-flex align-items-center">
                      <input type="checkbox" name="selected_tickets[]" id="allchecetticket" value="{{ $ticket->id }}"
                          class="me-2 ticketCheckbox">
                      {{ $no++ }}
                  </td>
                  <td>
                      <a href="{{ route('dashbord.ticket.show', $ticket->id) }}">{{ $ticket->id }}</a>
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
                      {{ date('y/m/d h:i A', strtotime($ticket->startdate)) }}

                  </td>
                  <td>
                      {{ date('y/m/d h:i A', strtotime($ticket->enddate)) }}

                  </td>

                  {{-- <td>
                                        {{ $ticket->created_at->format('Y-m-d h:i A') }}

                                    </td> --}}

                  <td>
                      <x-ticket :state="$ticket->state" />

                  </td>



                  <td>
                      @if (auth()->user()->role === 'employee' && ($ticket->state == 'opened' || $ticket->state == 'reject'))
                          <div class="dropdown">
                              <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                  Actions
                              </button>
                              <ul class="dropdown-menu">

                                  @if ($ticket->state == 'opened')
                                      <li>
                                          <a class="dropdown-item"
                                              href="{{ route('dashbord.ticket.edit', $ticket->id) }}">Edit</a>
                                      </li>
                                      <li>
                                          <a class="dropdown-item"
                                              href="{{ route('dashbord.ticket.state', $ticket->id) }}">

                                              Close
                                          </a>
                                      </li>

                                      @if (auth()->user()->role !== 'employee' && $ticket->state != 'approved')
                                          <li>
                                              <a class="dropdown-item"
                                                  href="{{ route('dashbord.ticket.state', $ticket->id) }}">

                                                  Approve
                                              </a>
                                          </li>
                                      @endif
                                  @endif


                                  <li>
                                      <a class="dropdown-item"
                                          href="{{ route('dashbord.ticket.destroy', $ticket->id) }}" id="delete">

                                          Remove
                                      </a>
                                  </li>

                              </ul>
                          </div>
                      @elseif (auth()->user()->role !== 'employee')
                          <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  Actions
                              </button>
                              <ul class="dropdown-menu">

                                  <li>
                                      @if ($ticket->state != 'approved')
                                          <a class="dropdown-item"
                                              href="{{ route('dashbord.pending.approve', $ticket->id) }}">

                                              Approve
                                          </a>
                                      @endif

                                  </li>
                                  <li>
                                      <a class="dropdown-item"
                                          href="{{ route('dashbord.ticket.edit', $ticket->id) }}">Edit</a>
                                  </li>


                                  <li>
                                      <a class="dropdown-item"
                                          href="{{ route('dashbord.ticket.destroy', $ticket->id) }}" id="delete">

                                          Remove
                                      </a>
                                  </li>

                              </ul>
                          </div>
                      @else
                          NO Action
                      @endif



                  </td>
              </tr>
          @endforeach
