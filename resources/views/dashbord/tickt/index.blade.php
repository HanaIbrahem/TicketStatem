@extends('dashbord.layout.master')
@php
    $no = 1;
@endphp

@section('datatablecss')
    <link rel="stylesheet" href="{{ asset('dashbord/assets/datatable/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashbord/assets/datatable/css/style.css') }}">
@endsection

@section('main')


    <div class="row">

        <div class="card">
            <div class="card-header">
                <h3>
                    Ticket List
                </h3>

            </div>

            <div class="card-body">

                {{-- <div class="row">
                <div class="col-md-4 col-sm-12 mb-xl-3 mb-sm-4">
                    <div class="form-group">
                        <label for="suggestions">From</label>
    
                        <input type="datetime-local" class="form-control" id="datetimeInput" value="<?php echo date('Y-m-d\TH:i'); ?>">
    
    
                    </div>
                </div>
    
                <div class="col-md-4 col-sm-12 mb-xl-3 mb-sm-4">
                    <div class="form-group">
                        <label for="suggestions">To</label>
                        <input type="datetime-local" class="form-control" id="datetimeInput" value="<?php echo date('Y-m-d\TH:i'); ?>">
    
                    </div>
                </div>
            </div> --}}
                <div class="table-responsive">

                    <table id="example" class="table">
                        <thead style="font-size: 12px">
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    ID
                                </th>

                                <th>
                                    From
                                </th>
                                <th>
                                    Place
                                </th>
                                <th>
                                    DiliveryType
                                </th>
                                <th>
                                    ProblemOn
                                </th>
                                <th>
                                    Detail
                                </th>

                                <th>
                                    Solution
                                </th>

                                <th >
                                    Note
                                </th>
                                <th>
                                    OpenDate
                                </th>
                                <th>
                                    CloseDate
                                </th>
                                {{-- <th>
                                    CreatedAt
                                </th> --}}
                                <th>
                                    Status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px">


                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <input type="checkbox" name="selected_tickets[]" id="allchecetticket" value="{{ $ticket->id }}" class="me-2 ticketCheckbox">
                                        {{ $no++ }}
                                    </td>
                                    <td>
                                        <a href="{{route('dashbord.ticket.show',$ticket->id )}}">{{ $ticket->id }}</a>
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
                                        {{ date("y/m/d h:i A",strtotime($ticket->startdate)) }}

                                    </td>
                                    <td>
                                        {{  date("y/m/d h:i A",strtotime($ticket->enddate)) }}

                                    </td>

                                    {{-- <td>
                                        {{ $ticket->created_at->format('Y-m-d h:i A') }}

                                    </td> --}}

                                    <td>
                                        <x-ticket :state="$ticket->state" />

                                    </td>



                                    <td>
                                        @if (auth()->user()->role === 'employee' && ($ticket->state == 'opened' || $ticket->state == 'reject') )
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
                                                            href="{{ route('dashbord.ticket.destroy', $ticket->id) }}"
                                                            id="delete">

                                                            Remove
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>


                                        @elseif (auth()->user()->role !== 'employee')

                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
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
                                                        href="{{ route('dashbord.ticket.destroy', $ticket->id) }}"
                                                        id="delete">

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
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <input type="checkbox" id="selectAllBtn"> Check All
                    @if (auth()->user()->role =='employee')
                    <a href="#" data-state="pending" id="allstate" class="btn btn-sm btn-warning ms-1">Close
                        All</a>
                    @endif
                    @if (auth()->user()->role !=='employee')
                    <a href="#" data-state="approved" id="allstate" class="btn btn-sm btn-success ms-1">Approve All</a>
                    @endif
                    <a href="#" data-state="remove" id="allstate" class="btn btn-sm btn-danger allstate ms-1">Remove
                        All</a>
                </div>
            </div>

        </div>

    </div>

 
@endsection


@section('datatablejs')
    <script src="{{ asset('dashbord/assets/datatable/js/datatables.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashbord/assets/datatable/js/custom.js') }}"></script>
@endsection

@section('selectboxjs')
    <script>
        //seelct checkbox 
        $(document).ready(function() {
            $('#selectAllBtn').change(function() {
                $('.ticketCheckbox').prop('checked', $(this).prop('checked'));
            });
        });

        //jqury request for reject all or accept all
        $(document).ready(function() {
            $(document).on('click', '#allstate', function(event) {
                event.preventDefault();
                var stete = $(this).data('state');
                var selectedTickets = [];
                $('#allchecetticket:checked').each(function() {
                    selectedTickets.push($(this).val());
                });
                console.log(selectedTickets);
                ticketstate(stete, selectedTickets)
            });
        });

        function ticketstate(ticketstate, selectedtickets) {
            $.ajax({
                type: "GET",
                data: {
                    stete: ticketstate,
                    selectedTickets: selectedtickets
                },
                url: "{{ route('dashbord.ticket.all') }}",
                success: function(response) {
                    // $('#ticketdata').html(data);
                    toastr[response['alert-type']](response['message']);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection


@section('switalertjs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('dashbord/assets/js/sweetalert.init.js')}}"></script>
@endsection

