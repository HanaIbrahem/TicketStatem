@foreach ($tickets as $ticket)
    <div class="col-md-12 mb-0 mt-0 rounded">
        <div class="card mb-1">
            <div class="card-body pt-2 pb-2 bg-{{ $loop->iteration % 2 == 0 ? 'light' : 'even' }}">
                <div class="row">
                    <div class="col-md-6">
                        <h4>
                            <a href="{{ route('dashbord.ticket.show', $ticket->id) }}">
                                <span class="text-primary p-1"> ID{{ $ticket->id }} </span>
                                {{ $ticket->issuetype }}
                                <span class="small"> On {{ $ticket->problemType->title }}</span>
                            </a>
                        </h4>
                    </div>
                    <div class="col-md-2 col-lg-3 col-xxl-2  col-3  text-right">
                        <small><x-statecheck :state="$ticket->state" /></small>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xxl-2 col-9 text-right">
                        <small>Last Update {{ $ticket->updated_at->format('y/m/d h:i A') }}</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">

                        <p class="mb-1"><strong>Request From:</strong> {{ $ticket->requestFrom->title }} &nbsp;
                            &nbsp; <strong>Place:</strong> {{ $ticket->place }} </p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="mb-1"><strong>Delivered on:</strong> {{ $ticket->deliverytype }} </p>

                    </div>

                    <div class="col-md-6">
                        <p class="mb-1"><strong>Solution:</strong> {{ $ticket->solution->title }} </p>
                    </div>

                    <div class="col-md-6">
                        @if ($ticket->note != '')
                            <p class="mb-1"><strong>Note:</strong> {{ $ticket->note }}</p>
                        @endif


                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="mb-1 mt-1 small">
                            <strong>Opend:</strong>{{ date('y/m/d h:i A', strtotime($ticket->startdate)) }} &nbsp;
                            &nbsp; <strong>Closed:</strong> {{ date('y/m/d h:i A', strtotime($ticket->enddate)) }}</p>
                    </div>
                    @if ($ticket->state == 'opened' && auth()->user()->role === 'employee')
                        <div class="col-md-6 col-sm-12">

                            <a class="btn btn-sm btn-outline-info"
                                href="{{ route('dashbord.ticket.edit', $ticket->id) }}">Edit</a>

                            <a class="btn btn-sm btn-outline-warning"
                                href="{{ route('dashbord.ticket.state', $ticket->id) }}">
                                Close
                            </a>
                            <a class="btn btn-sm btn-outline-danger" id="delete"
                                href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                                Remove
                            </a>
                        </div>
                        @if ($ticket->state == 'reject')
                            <div class="col-md-6 col-sm-12">

                                <a class="btn btn-sm btn-outline-danger" id="delete"
                                    href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                                    Remove
                                </a>
                            </div>
                        @endif
                    @elseif (auth()->user()->role !== 'employee')
                        <div class="col-md-6 col-sm-12">

                            <a class="btn btn-sm btn-outline-info"
                                href="{{ route('dashbord.ticket.edit', $ticket->id) }}">Edit</a>

                            @if ($ticket->state != 'approved')
                                <a class="btn btn-sm btn-outline-warning"
                                    href="{{ route('dashbord.pending.approve', $ticket->id) }}">
                                    Approve
                                </a>
                            @endif

                            <a class="btn btn-sm btn-outline-danger" id="delete"
                                href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                                Remove
                            </a>
                            <div class="col-md-6 col-sm-12">
                    @endif

                    {{-- <div class="col-12">
                    <p class="mb-1"><strong>Request From:</strong> {{ $ticket->requestFrom->title }} &nbsp;
                        &nbsp; Place {{ $ticket->place }} </p>

                    <p class="mb-1"><strong>Delivered on:</strong> {{$ticket->deliverytype}} &nbsp; &nbsp; <strong>Solution:</strong> {{ $ticket->solution->title }}</p>
                    @if ($ticket->note != '')
                        <p class="mb-1"><strong>Note:</strong> {{ $ticket->note }}</p>
                    @endif
                    <p class="mb-1 mt-1 small"> <strong>OpenDate:</strong>{{ $ticket->startdate }} &nbsp;
                        &nbsp; <strong>CloseDate:</strong> {{ $ticket->enddate }}</p>

                    @if ($ticket->state == 'opened' && auth()->user()->role === 'employee')
                        <a class="btn btn-sm btn-outline-info"
                            href="{{ route('dashbord.ticket.edit', $ticket->id) }}">Edit</a>

                        <a class="btn btn-sm btn-outline-warning"
                            href="{{ route('dashbord.ticket.state', $ticket->id) }}">
                            Close
                        </a>
                        <a class="btn btn-sm btn-outline-danger" id="delete"
                            href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                            Remove
                        </a>
                        @if ($ticket->state == 'reject')
                            <a class="btn btn-sm btn-outline-danger" id="delete"
                                href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                                Remove
                            </a>
                        @endif
                    @elseif (auth()->user()->role !== 'employee')
                        <a class="btn btn-sm btn-outline-info"
                            href="{{ route('dashbord.ticket.edit', $ticket->id) }}">Edit</a>

                        @if ($ticket->state != 'approved')
                            <a class="btn btn-sm btn-outline-warning"
                                href="{{ route('dashbord.pending.approve', $ticket->id) }}">
                                Approve
                            </a>
                        @endif

                        <a class="btn btn-sm btn-outline-danger" id="delete"
                            href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                            Remove
                        </a>
                    @endif



                </div> --}}
                </div>

            </div>
        </div>
    </div>
@endforeach

<div id="pag" class="pagination pagination-primary m-4 pagination-wrap">
    {{ $tickets->links('vendor.pagination.custom') }}
</div>
