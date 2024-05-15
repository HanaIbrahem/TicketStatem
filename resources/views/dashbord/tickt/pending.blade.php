@extends('dashbord.layout.master')


@section('datatablecss')
<link rel="stylesheet" href="{{asset('dashbord/assets/datatable/css/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('dashbord/assets/datatable/css/style.css')}}">

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
            <input type="checkbox" id="checkAll"> Check All

            <div class="row">
                <div class="col-6">
                    <a href="{{route('dashbord.pending.allstate','approved')}}" class="btn btn-success">Accept All</a>
                    <a href="{{route('dashbord.pending.allstate','reject')}}" class="btn  btn-danger">Reject All</a>
                </div>
            </div>
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
                    <tbody  id="ticketdata" >
                    
                            @include('dashbord.includes.pending')

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection


@section('datatablejs')
<script src="{{asset('dashbord/assets/datatable/js/datatables.min.js')}}"></script>
<script src="{{asset('dashbord/assets/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{asset('dashbord/assets/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{asset('dashbord/assets/datatable/js/custom.js')}}"></script>
@endsection

@section('selectboxjs')
<script>
     console.log('Ticket ID:');
</script>
<script>
   $(document).ready(function() {
    $(document).on('click', '.dropdown-item', function(event) {
        event.preventDefault();
        var ticketId = $(this).data('ticket-id');
        var action = $(this).data('ticket-action');
        console.log(ticketId);

        getMoreTickets(ticketId,action);
    });
});

function getMoreTickets(ticketId,action) {
    $.ajax({
        type: "GET",
        data: {
            ticketId: ticketId,
            action:action,
        },
        url: "{{ route('dashbord.pending.state') }}",
        success: function(data) {
                    $('#ticketdata').html(data);
                    console.log(data);

        }, error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
        }
    });
}

// JavaScript
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('checkAll').addEventListener('change', function() {
        var checkboxes = document.getElementsByClassName('ticketCheckbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });

    var checkboxes = document.getElementsByClassName('ticketCheckbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function() {
            var checkAllCheckbox = document.getElementById('checkAll');
            checkAllCheckbox.checked = true;
            for (var j = 0; j < checkboxes.length; j++) {
                if (!checkboxes[j].checked) {
                    checkAllCheckbox.checked = false;
                    break;
                }
            }
        });
    }
});

</script>
@endsection
