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
    <link rel="stylesheet" href="{{ asset('dashbord/assets/selectbox/virtual-select.min.css') }}">
    <style>
        
    </style>
@endsection
@section('main')



    <div class="row">
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
                            <h4 class="card-title">Ticket Information</h4>
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
                            <div class="row pt-3 mb-3">


                                <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                    <div class="form-group">
                                        <label for="suggestions">Request From</label>

                                        <select required name="requestfrom" class="form-control mr-sm-2" id="select"
                                            placeholder="From" data-search="true" data-silent-initial-value-set="true">
                                            @foreach ($requetsFroms as $request)
                                                <option value="{{ $request->id }}">{{ $request->title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                    <div class="form-group">
                                        <label for="suggestions">Place</label>

                                        <select required name="place" class="form-control mr-sm-2"
                                             id="select" placeholder="PLace"
                                            data-search="true" data-silent-initial-value-set="true">
                                            @foreach ($places as $place)
                                                <option value="{{ $place }}">{{ $place }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <!--/row-->
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                    <div class="form-group">
                                        <label for="suggestions">Issue Type</label>

                                        <select required name="issuetype" class="form-control mr-sm-2"
                                             id="select" placeholder="Issue"
                                            data-search="true" data-silent-initial-value-set="true">
                                            @foreach ($issues as $issue)
                                                <option value="{{ $issue }}">{{ $issue }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                    <div class="form-group">
                                        <label for="suggestions">More Detail</label>

                                        <select required name="problemtype" class="form-control mr-sm-2" id="select"
                                            placeholder="Issue Detail" data-search="true"
                                            data-silent-initial-value-set="true">
                                            @foreach ($problemTypes as $problem)
                                                <option value="{{ $problem->id }}">{{ $problem->title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                            </div>

                            {{-- Delivery type and solution --}}
                            <div class="row mb-3">
                                <div class="col-md-8 col-sm-12 mt-xl-3 mt-sm-4">
                                    <div class="form-group">
                                        <label for="suggestions">Solution</label>

                                        <select required name="solution" 
                                            class="form-control mr-sm-2" id="select" placeholder="Solution"
                                            data-search="true" data-silent-initial-value-set="true">
                                            @foreach ($solutions as $solution)
                                                <option value="{{ $solution->id }}">{{ $solution->title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 mt-xl-3 mt-sm-2">
                                    <div class="form-group">
                                        <label for="suggestions">Delivery Type</label>

                                        <select required name="delivery" class="form-control mr-sm-2" placeholder="Delivery"
                                            id="select" data-search="true" data-silent-initial-value-set="true">
                                            @foreach ($deliverytype as $dilivery)
                                                <option value="{{ $dilivery }}">{{ $dilivery }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>

                            {{-- Open Date and end date --}}
                            <div class="row pt-3">

                                <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                    <div class="form-group">
                                        <label for="suggestions">Open Date</label>

                                        <input required name="opendate" type="datetime-local" class="form-control"
                                            id="datetimeInput" value="<?php echo date('Y-m-d\TH:i'); ?>">


                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 mt-xl-3 mt-sm-4">
                                    <div class="form-group">
                                        <label for="suggestions">Close Date</label>
                                        <input required name="enddate" type="datetime-local" class="form-control"
                                            id="datetimeInput" value="<?php echo date('Y-m-d\TH:i'); ?>">

                                    </div>
                                </div>
                            </div>


                            {{-- Note --}}
                            <div class="row">
                                <div class="col-12 mt-xl-3 mt-sm-2">
                                    <div class="form-group">
                                        <label for="suggestions">Note</label>

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
    </div>
@endsection

@section('selectboxjs')
    <script src="{{ asset('dashbord/assets/selectbox/virtual-select.min.js') }}"></script>
    <script>
        VirtualSelect.init({
            ele: '#select'
        });
    </script>
@endsection
