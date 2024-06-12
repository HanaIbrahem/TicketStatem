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

                <form  method="GET" id="dateform">
                    @csrf
                    <div class="row mb-4">

                        <div class="col-md-3 col-sm-12 mt-xl-3 mt-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="suggestions">From</label>

                                <input required name="fromdate" type="datetime-local" class="form-control"
                                    id="datetimeInput" value="{{$startDate->format('Y-m-d\TH:i')}}">


                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12 mt-xl-3 mt-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="suggestions">To</label>
                                <input required name="todate" type="datetime-local" class="form-control"
                                    id="datetimeInput" value="{{$currentDate->format('Y-m-d\TH:i')}}">

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-6 mt-xl-3 mt-sm-4">
                            <div class="mb-3 has-danger">
                                <label class="form-label">Date Order</label>
                                <select required name="order" class="form-select mr-sm-2" id=""
                                    placeholder="Order By" data-search="true" data-silent-initial-value-set="true">
                                    <option value="created_at">Created At</option>
                                    <option value="startdate">Opened At</option>
                                    <option value="enddate">Closed At</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-6 mt-xl-3 mt-sm-5">

                            <input type="submit" class="btn btn-outline-info mt-4" value="Search">
                        </div>
                        
                    </div>
                </form>
                
                <div class="table-responsive" >

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
                  
                                <th>
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

                        <tbody  id="ticketdata" style="font-size: 12px" >
                                @include('dashbord.includes.ticket_list')


                        </tbody>
                      
                    </table>
                </div>
                <div class="mt-4">
                    <input type="checkbox" id="selectAllBtn"> Check All
                    @if (auth()->user()->role == 'employee')
                        <a href="#" data-state="pending" id="allstate" class="btn btn-sm btn-warning ms-1">Close
                            All</a>
                    @endif
                    @if (auth()->user()->role !== 'employee')
                        <a href="#" data-state="approved" id="allstate" class="btn btn-sm btn-success ms-1">Approve
                            All</a>
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

    <script>
            $(document).ready(function() {
            $('#dateform').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                var table = $('#example').DataTable();

                $.ajax({
                    url: '{{ route('dashbord.ticket.dateorder') }}', // Route to handle form submission
                    method: 'GET',
                    data: formData,
                    success: function(data) {
                        // Handle success response
                        table.clear().draw();

                        $('#ticketdata').html(data);

                        table.rows.add($('#ticketdata tr')).draw();

                        // Display success message or update UI
                       
                   
                       
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                     
                    }
                });
            });
        });
    </script>
@endsection


@section('switalertjs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('dashbord/assets/js/sweetalert.init.js') }}"></script>
@endsection
