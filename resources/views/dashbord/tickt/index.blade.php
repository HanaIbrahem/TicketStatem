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
                        <thead>
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

                                <th>
                                    Note
                                </th>
                                <th>
                                    OpenDate
                                </th>
                                <th>
                                    CloseDate
                                </th>
                                <th>
                                    CreatedAt
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        {{ $no++ }}
                                    </td>
                                    <td>
                                        {{ $ticket->id }}
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
                                        @if (auth()->user()->role === 'employee' && ($ticket->state == 'opened' || $ticket->state == 'reject') )
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
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

@section('switalertjs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('dashbord/assets/js/sweetalert.init.js')}}"></script>
@endsection
