@extends('dashbord.layout.master')

@php
    // Get the start of the current month
    // Get the start of the current month
    $startOfMonth = date('Y-m-01');

    // Format the date and time for datetime-local input
    $formattedDateTime = date('Y-m-d\TH:i', strtotime($startOfMonth . ' 12:12:11'));

@endphp
@section('datatablecss')
    <style>
        .bg-odd {
            background-color: rgba(235, 236, 226, 0.842);
        }

        .bg-even {
            background-color: rgba(204, 243, 204, 0.842);
        }
    </style>
@endsection

@section('main')
    <div class="row bg-white">
        <div class="col-12 p-2 m-2 mt-4">
            <h3>
                Your Tickets
            </h3>
        </div>

        {{-- <div class="row mb-2">
            <form action="{{ route('dashbord.ticket.dateorder') }}" method="POST" id="form">
                @csrf
                @method('POST')

                <div class="row">
                <div class="col-md-4 col-sm-12 mb-xl-3 mb-sm-4">
                    <div class=" row align-items-center">
                        <label for="exampleInputText1" class="form-label col-sm-3 col-form-label">From</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" name="fromdate" value="{{$formattedDateTime}}" class="form-control" id=""
                                >
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 mb-xl-3 mb-sm-4">
                    <div class="row align-items-center">
                        <label for="exampleInputText1" class="form-label col-sm-3 col-form-label">To</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>"
                                id="exampleInputText1"  name="todate">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 mb-xl-3 mb-sm-3 ">
                    <div class="form-group">

                        <input type="submit"  class="btn btn-outline-success" value="Confirm">
                    </div>
                </div>
                </div>
            </form>

        </div> --}}
        <div id="ticketdata">
            @include('dashbord.tickt.mortecket')

        </div>

        {{-- <div class="row g-4 g-xl-5 slider-container d-flex justify-content-center">

   
            @foreach ($tickets as $ticket)
                <div class="col-lg-6 col-xxl-4 col-sm-6 col-md-6 text-start mb-0 mt-1 p-1 " style="">
                    <div class="card shadow-lg h-100 bg-light">
                        <div class="card-body text-start d-flex flex-column pb-0">
                            <h4 class="">
                                <a class="text-dark" href="{{ route('dashbord.ticket.show', $ticket->id) }}">
                                    <span class=""> ID{{ $ticket->id }} </span>
                                    {{ $ticket->issuetype }}
                                    <span class="small"> On {{ $ticket->problemType->title }}</span>
                                </a>
                            </h4>
                            <p class="mb-1 text-dark"> <small><x-statecheck :state="$ticket->state" /></small>
                                <small>Last Update {{ $ticket->updated_at->format('y/m/d h:i A') }}</small>
                            </p>
                            <p class="mb-1"><strong>Request From:</strong> {{ $ticket->requestFrom->title }} &nbsp;
                                &nbsp; <strong>Place:</strong> {{ $ticket->place }} </p>
                            <p class="mb-1"><strong>Solution:</strong> {{ $ticket->solution->title }} </p>
                            <p class="mb-1"><strong>Delivered on:</strong> {{ $ticket->deliverytype }} </p>
                            @if ($ticket->note != '')
                                <p class="mb-1"><strong>Note:</strong> {{ $ticket->note }}</p>
                            @endif
                            <p class="mb-1 mt-1 small">
                                <strong>Opend:</strong>{{ date('y/m/d h:i A', strtotime($ticket->startdate)) }} &nbsp;
                                &nbsp; <strong>Closed:</strong> {{ date('y/m/d h:i A', strtotime($ticket->enddate)) }}</p>

                            @if ($ticket->state == 'opened' && auth()->user()->role === 'employee')
                                <div class="p-1">

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
                                    <div class="p-1">

                                        <a class="btn btn-sm btn-outline-danger" id="delete"
                                            href="{{ route('dashbord.ticket.destroy', $ticket->id) }}">
                                            Remove
                                        </a>
                                    </div>
                                @endif
                            @elseif (auth()->user()->role !== 'employee')
                                <div class="p-1">

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
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
    </div>
@endsection

@section('switalertjs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('dashbord/assets/js/sweetalert.init.js') }}"></script>



    <script>
        $(document).ready(function() {
            $(document).on('click', '#pag .pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMoreTickets(page);
            });
        });


        function getMoreTickets(page) {




            $.ajax({
                type: "GET",
                data: {
                    page: page,
                },
                url: "{{ route('dashbord.ticket.more') }}" + "?page=" + page,
                success: function(data) {
                    $('#ticketdata').html(data);
                }
            });
        }
    </script>
@endsection
