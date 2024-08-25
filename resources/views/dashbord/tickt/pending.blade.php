@extends('dashbord.layout.master')


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

                {{-- <div class="row">
                <div class="col-6">
                    <a href="{{route('dashbord.pending.allstate','approved')}}" class="btn btn-success">Accept All</a>
                    <a href="{{route('dashbord.pending.allstate','reject')}}" class="btn  btn-danger">Reject All</a>
                </div>
            </div> --}}
                <div class="table-responsive">

                    <table id="example" class="table display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    ID
                                </th>
                                <th>
                                    OpenedBy
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
                                    Reason
                                </th>
                                <th>
                                    Responsibility
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
                        <tbody id="ticketdata">

                            @include('dashbord.includes.pending')

                        </tbody>
                    </table>

                </div>
                <div class="mt-4">
                    <input type="checkbox" id="selectAllBtn"> Check All
                    <a href="#" data-state="approved" id="allstate" class="btn btn-sm btn-success ms-1">Approve
                        All</a>
                    <a href="#" data-state="reject" id="allstate" class="btn btn-sm btn-danger allstate ms-1">Reject
                        All</a>
                </div>
            </div>
            {{-- <button id="selectAllBtn" class="btn btn-primary">Select All</button> --}}

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
        $(document).ready(function() {
            $(document).on('click', '.dropdown-item', function(event) {
                event.preventDefault();
                var ticketId = $(this).data('ticket-id');
                var action = $(this).data('ticket-action');
                console.log(ticketId);

                getMoreTickets(ticketId, action);
            });
        });

        function getMoreTickets(ticketId, action) {
            $.ajax({
                type: "GET",
                data: {
                    ticketId: ticketId,
                    action: action,
                },
                url: "{{ route('dashbord.pending.state') }}",
                success: function(data) {

                    $('#ticketdata').html(data);
                    toastr.info('ticket stetd changed');

                    console.log(data);

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        }

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
                // console.log(selectedTickets);
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
                url: "{{ route('dashbord.pending.allstate') }}",
                success: function(response) {
                    // $('#ticketdata').html(data);
                    console.log(response);
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
