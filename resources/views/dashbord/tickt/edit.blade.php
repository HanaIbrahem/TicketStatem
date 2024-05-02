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
                <h4 class="mb-0 text-white">Edit Your Ticket</h4>
            </div>

            <form action="{{ route('dashbord.ticket.update') }}" method="POST">
                @csrf
                @method('POST')
                <div>
                    <input type="hidden" value="{{ $ticket->id }}" name="id">

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
                                    <input type="text" value="{{ $ticket->requestFrom->title }}" class="form-control"
                                        id="requetsfrom" autocomplete="off">

                                    <input type="hidden" id="requestfromDataHidden" name="requetsfrom"
                                        value="{{ $ticket->requestFrom->id }}">


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
                                            <option {{ $ticket->place == $place ? 'selected' : '' }}
                                                value="{{ $place }}  ">{{ $place }}</option>
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
                                            <option value="{{ $issue }}"
                                                {{ $ticket->issuetype == $issue ? 'selected' : '' }}>{{ $issue }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">More Detail</label>
                                    <input type="text" value="{{ $ticket->problemType->title }}" class="form-control"
                                        id="problemtype" autocomplete="off">
                                    <input type="hidden" id="problemtypeDataHidden" name="problemtype"
                                        value="{{ $ticket->problemType->id }}">

                                    <div id="probletypesugestion" class="mt-2 suggestionss"></div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Solution</label>
                                    <input type="text" value="{{ $ticket->solution->title }}" class="form-control"
                                        id="solution" autocomplete="off">

                                    <div id="solutionsugestion" class="mt-2 suggestionss"></div>
                                    <input type="hidden" id="solutionDataHidden" name="solution"
                                        value="{{ $ticket->solution->id }}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">

                                    <label class="form-label">Delivery Type</label>

                                    <select required name="delivery" class="form-select mr-sm-2" placeholder="Delivery">
                                        @foreach ($deliverytype as $dilivery)
                                            <option {{ $ticket->deliverytype == $dilivery ? 'selected' : '' }}
                                                value="{{ $dilivery }}">{{ $dilivery }}</option>
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
                                        id="datetimeInput" value="{{ $ticket->startdate }}">


                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="suggestions">Close Date</label>
                                    <input required name="enddate" type="datetime-local" class="form-control"
                                        id="datetimeInput" value="{{ $ticket->enddate }}">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-xl-3 mt-sm-2">
                                <div class="form-group">
                                    <label class="form-label" for="suggestions">Note</label>

                                    <textarea name="note" class="form-control" rows="3" placeholder="Note Here...">{{ $ticket->note }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="card-body border-top">

                            <input type="submit" class="btn btn-primary" value="Update">
                            <input type="reset" class="btn bg-danger-subtle text-danger ms-6" value="Cancel">

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end Person Info -->
    </div>
@endsection

@section('selectboxjs')
    <script>
        $(document).ready(function() {


            var requestFromData = {!! json_encode($requetsFroms->toArray()) !!};
            var problemTypeData = {!! json_encode($problemTypes->toArray()) !!};
            var solutionData = {!! json_encode($solutions->toArray()) !!};

            function bindInputEvents(inputId, suggestions, suggestionsContainer, hiddenInputId) {
                $(inputId).on('input', function() {
                    var query = $(this).val().toLowerCase();
                    if (query === '') {
                        $(suggestionsContainer).empty();
                        $(hiddenInputId).val(
                            ''); // Set hidden input value to empty when search text is removed
                        return;
                    }

                    var filteredSuggestions = suggestions.filter(function(item) {
                        return item.title.toLowerCase().includes(query);
                    });

                    displaySuggestions(filteredSuggestions, suggestionsContainer, hiddenInputId);
                });

                // Event delegation to handle clicks on suggestions
                $(suggestionsContainer).on('click', '.suggestion', function() {
                    var selectedSuggestion = $(this).text();
                    var selectedId = suggestions.find(function(item) {
                        return item.title === selectedSuggestion;
                    }).id;
                    $(hiddenInputId).val(selectedId);
                    $(inputId).val(selectedSuggestion); // Set input value to selected suggestion text
                    $(suggestionsContainer).empty(); // Clear suggestions after selection
                });
            }

            function displaySuggestions(suggestions, suggestionsContainer, hiddenInputId) {
                var suggestionsList = $(suggestionsContainer);
                suggestionsList.empty();
                if (suggestions.length > 0) {
                    $.each(suggestions, function(index, suggestion) {
                        suggestionsList.append('<div class="suggestion">' + suggestion.title + '</div>');
                    });
                } else {
                    suggestionsList.append('<div>No suggestions found</div>');
                    $(hiddenInputId).val(''); // Set hidden input value to empty when no suggestions are found
                }
            }

            bindInputEvents('#requetsfrom', requestFromData, '#requetsfromsugestion', '#requestfromDataHidden');
            bindInputEvents('#problemtype', problemTypeData, '#probletypesugestion', '#problemtypeDataHidden');
            bindInputEvents('#solution', solutionData, '#solutionsugestion', '#solutionDataHidden');
        });
    </script>
@endsection
