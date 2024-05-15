@extends('dashbord.layout.master')

@php
    $issues = ['Hardwar', 'Softwar', 'Network', 'Security', 'Email'];
    $deliverytype = ['Email', 'Phone Call', 'Remote', 'On Site Support', 'Video Call'];
    $places = [
        'Market-Erbil',
        'Market-Mousl',
        'HQ-Alwa',
        'Office Kwestan',
        'Office Shaqlawa',
        'HQ Musel',
        'WareHouse Erbil',
        'WareHouse Mosel',
    ];

@endphp

@section('datatablecss')
    <style>
        .suggestionss {
            max-height: 200px;
            overflow-y: auto;
        }

        .suggestion {
            padding: 5px 10px;
            margin: 5px;
            background-color: #f5f5f5;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
@endsection
@section('main')
    <div class="col-12">
        <!-- start Person Info -->
        <div class="card">
            <div class="card-header text-bg-primary">
                <h4 class="mb-0 text-white">Open New Ticket</h4>
            </div>

            <form action="{{ route('dashbord.ticket.store') }}" method="POST">
                @csrf
                @method('POST')
                <div>
                    <div class="card-body">
                        <h4 class="card-title">Ticket information</h4>
                        <div class="row">
                            <div class="col">
                                @if (count($errors))
                                    <div class="alert text-danger p-1">
                                        @foreach ($errors->all() as $message)
                                            <p class="m-0 p-0">{{ $message }}</p>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row pt-3">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Request From</label>
                                    <input type="text" class="form-control" id="requetsfrom" autocomplete="off">

                                    <input type="hidden" id="requestfromDataHidden" name="requetsfrom" value="">


                                    <div id="requetsfromsugestion" class="mt-2 suggestionss"></div>
                                  
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="mb-3 has-danger">
                                    <label class="form-label">Place</label>
                                    <select required name="place" class="form-select mr-sm-2" id=""
                                        placeholder="PLace" data-search="true" data-silent-initial-value-set="true">
                                        @foreach ($places as $place)
                                            <option value="{{ $place }}">{{ $place }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 has-success">
                                    <label class="form-label">Issue Type</label>


                                    <select required name="issuetype" class="form-select mr-sm-2" id=""
                                        placeholder="Issue" data-search="true" data-silent-initial-value-set="true">
                                        @foreach ($issues as $issue)
                                            <option value="{{ $issue }}">{{ $issue }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">More Detail</label>
                                    <input type="text" class="form-control" id="problemtype" autocomplete="off">
                                    <input type="hidden" id="problemtypeDataHidden" name="problemtype" value="">

                                    <div id="probletypesugestion" class="mt-2 suggestionss"></div>
                                    <button type="button" class="btn mb-1 mt-1 btn-sm bg-primary-subtle text-primary "
                                    data-bs-toggle="modal" data-bs-target="#problem-modal">
                                    Add Detail
                                </button>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Solution</label>
                                    <input type="text" class="form-control" id="solution" autocomplete="off">

                                    <div id="solutionsugestion" class="mt-2 suggestionss"></div>
                                    <input type="hidden" id="solutionDataHidden" name="solution" value="">


                                    <button type="button" class="btn mb-1 mt-1 btn-sm bg-primary-subtle text-primary "
                                        data-bs-toggle="modal" data-bs-target="#solution-modal">
                                        Add Solution
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">

                                    <label class="form-label">Delivery Type</label>

                                    <select required name="delivery" class="form-select mr-sm-2" placeholder="Delivery">
                                        @foreach ($deliverytype as $dilivery)
                                            <option value="{{ $dilivery }}">{{ $dilivery }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->

                            <!--/span-->





                        </div>

                        <div class="row pt-3">

                            <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="suggestions">Open Date</label>

                                    <input required name="opendate" type="datetime-local" class="form-control"
                                        id="datetimeInput" value="<?php echo date('Y-m-d\TH:i'); ?>">


                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="suggestions">Close Date</label>
                                    <input required name="enddate" type="datetime-local" class="form-control"
                                        id="datetimeInput" value="<?php echo date('Y-m-d\TH:i'); ?>">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-xl-3 mt-sm-2">
                                <div class="form-group">
                                    <label class="form-label" for="suggestions">Note</label>

                                    <textarea name="note" class="form-control" rows="3" placeholder="Note Here..."></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="card-body border-top">

                            <input type="submit" class="btn btn-primary" value="Save">
                            <input type="reset" class="btn bg-danger-subtle text-danger ms-6" value="Cancel">

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end Person Info -->
    </div>

    {{-- Modals --}}
    <div class="modal fade" id="solution-modal" tabindex="-1" aria-labelledby="solution-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="solution-modal-label">Solution</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Add New Solution</h5>
                    <div id="validation-messages"></div>
                    <form method="POST" id="add-solution-form">
                        @csrf
                        <input type="text" name="title" class="m2 form-control">
                        <input type="submit" class="mt-2 btn btn-secondary" value="Save">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger waves-effect text-start"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="problem-modal" tabindex="-1" aria-labelledby="problem-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="problem-modal-label">More Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Add New Problem</h5>
                <div id="problem-validation"></div>
                <form method="POST" id="add-problem-form">
                    @csrf
                    <input type="text" name="title" class="m2 form-control">
                    <input type="submit" class="mt-2 btn btn-secondary" value="Save">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-danger-subtle text-danger waves-effect text-start"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('selectboxjs')
    <script src="{{ asset('dashbord/assets/js/ticket.js') }}"></script>

    <script>
        var requestFromData = {!! json_encode($requetsFroms->toArray()) !!};
        var problemTypeData = {!! json_encode($problemTypes->toArray()) !!};
        var solutionData = {!! json_encode($solutions->toArray()) !!};
        //sugestion code
        $(document).ready(function() {
            suggestionsContent(requestFromData, problemTypeData, solutionData);
        });

        // for adding new solution
        $(document).ready(function() {
            $('#add-solution-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    url: '{{ route('dashbord.addsolution') }}', // Route to handle form submission
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Display success message or update UI
                        $('#validation-messages').html('<div class="alert alert-success">' +
                            response.message + '</div>');
                        // Clear the input field
                        $('#add-solution-form input[name="title"]').val('');
                   
                        solutionData.push(response.solution);
                        setTimeout(function() {
                            $('#solution-modal').modal('hide');
                            $('#validation-messages').empty();

                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        var errorResponse = JSON.parse(xhr.responseText);
                        if (errorResponse.errors && errorResponse.errors.title) {
                            // Display validation error message
                            var errorMessage = errorResponse.errors.title[0];
                            $('#validation-messages').html('<div class="alert alert-danger">' +
                                errorMessage + '</div>');
                            // Remove the error message after 4 seconds
                            setTimeout(function() {
                                $('#validation-messages').empty();

                            }, 4000); // 4 seconds (4000 milliseconds)
                        } else {
                            // Display general error message
                            $('#validation-messages').html(
                                '<div class="alert alert-danger">An error occurred. Please try again later.</div>'
                            );
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#add-problem-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    url: '{{ route('dashbord.addproblem') }}', // Route to handle form submission
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Display success message or update UI
                        $('#problem-validation').html('<div class="alert alert-success">' +
                            response.message + '</div>');
                        // Clear the input field
                        $('#add-problem-form input[name="title"]').val('');
                        
                        problemTypeData.push(response.problem);

                        setTimeout(function() {
                            $('#problem-modal').modal('hide');
                            $('#problem-validation').empty();

                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        var errorResponse = JSON.parse(xhr.responseText);
                        if (errorResponse.errors && errorResponse.errors.title) {
                            // Display validation error message
                            var errorMessage = errorResponse.errors.title[0];
                            $('#problem-validation').html('<div class="alert alert-danger">' +
                                errorMessage + '</div>');
                            // Remove the error message after 4 seconds
                            setTimeout(function() {
                                $('#problem-validation').empty();

                            }, 4000); // 4 seconds (4000 milliseconds)
                        } else {
                            // Display general error message
                            $('#problem-validation').html(
                                '<div class="alert alert-danger">An error occurred. Please try again later.</div>'
                            );
                        }
                    }
                });
            });
        });
    </script>
@endsection
