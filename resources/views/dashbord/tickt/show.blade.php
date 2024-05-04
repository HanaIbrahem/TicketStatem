@extends('dashbord.layout.master')

@section('main')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ticket Information</h4>

                <div class="row pt-3">
                    <div class="col-lg-4 col-xxl-2 col-sm-8">
                        <div class="mb-3">
                            <label for="requestFrom" class="form-label">Request From</label>
                            <p>{{ $ticket->requestFrom->title }}</p>
                            <div id="requestFromSuggestion" class="mt-2 suggestionss"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xxl-2 col-6">
                        <div class="mb-3">
                            <label for="place" class="form-label">Place</label>

                            <p>{{ $ticket->place }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-xxl-2 col-6">
                        <div class="mb-3">
                            <label for="issueType" class="form-label">Issue Type</label>
                            <p> {{ $ticket->issuetype }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xxl-2 col-6">
                        <div class="mb-3">
                            <label for="moreDetail" class="form-label">Problem on</label>
                            <p>{{ $ticket->problemType->title }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="solution" class="form-label">Solution</label>
                            <p>{{ $ticket->solution->title }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="deliveryType" class="form-label">Delivery Type</label>
                            <p>{{ $ticket->deliverytype }}</p>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-lg-4 col-xxl-2 col-6">
                        <div class="mb-3">
                            <label for="openDate" class="form-label">Open Date</label>
                            <p>{{ $ticket->startdate }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xxl-2 col-6">
                        <div class="mb-3">
                            <label for="closeDate" class="form-label">Close Date</label>
                            <p>{{ $ticket->enddate }}</p>
                        </div>
                    </div>
                </div>

                @if ($ticket->note != '')
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <p>{{ $ticket->note }}</p>
                            </div>
                        </div>
                    </div>
                @endif


                @if ($ticket->state == 'opened')
                    <a class="btn btn-outline-info" href="{{ route('dashbord.ticket.edit', $ticket->id) }}">Edit</a>

                    <a class="btn btn-outline-warning" href="{{ route('dashbord.ticket.state', $ticket->id) }}">
                        Close
                    </a>
                    <a class="btn btn-outline-danger" id="delete"
                        href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                        Remove
                    </a>
                @endif
               
                @if ($ticket->state == 'reject')
                <a class="btn btn-outline-danger" id="delete"
                href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                Remove
            </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('switalertjs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('dashbord/assets/js/sweetalert.init.js') }}"></script>
@endsection
