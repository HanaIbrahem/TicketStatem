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
                    Deleted Tickets 
                </h3>

            </div>

            <div class="card-body">

                
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
                                    DeletedAt
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

                            @include('dashbord.includes.trash')

                        </tbody>
                    </table>

                </div>
                <div class="mt-4">
                    <input type="checkbox" id="selectAllBtn"> Check All
                    <a href="#" data-state="restore" id="allstate" class="btn btn-sm btn-warning ms-1">Restore
                        All</a>
                    <a href="#" data-state="delete" id="allstate" class="btn btn-sm btn-danger allstate ms-1">Delete
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
                console.log(stete,selectedTickets);
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
                url: "{{ route('dashbord.trash.allstate') }}",
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
