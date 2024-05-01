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
                                    UserName
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
