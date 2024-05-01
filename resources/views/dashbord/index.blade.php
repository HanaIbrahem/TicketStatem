@extends('dashbord.layout.master')



@section('main')
    <div class="row">
        <div class="col-12">
            <!-- 5. card with background -->
            <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
                <h4 class="mb-0 fs-5">Ticket System</h4>
            </div>
        </div>

        <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-primary">
                <div class="card-body p-4">
                    <span>
                        <i class="ti ti-layout-grid fs-8"></i>
                    </span>
                    <h4 class="card-title mt-3 mb-0 text-white">{{$ticketCount}}</h4>
                    <p class="card-text text-white opacity-75 fs-3 fw-normal">
                        Tickets
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-success">
                <div class="card-body p-4">
                    <span>
                        <i class="ti ti-layout-grid fs-8"></i>
                    </span>
                    <h4 class="card-title mt-3 mb-0 text-white">{{$userCount}}</h4>
                    <p class="card-text text-white opacity-75 fs-3 fw-normal">
                        Users
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-warning">
                <div class="card-body p-4">
                    <span>
                        <i class="ti ti-layout-grid fs-8"></i>
                    </span>
                    <h4 class="card-title mt-3 mb-0 text-white">{{$requestFromCount}}</h4>
                    <p class="card-text text-white opacity-75 fs-3 fw-normal">
                        Place
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-danger">
                <div class="card-body p-4">
                    <span>
                        <i class="ti ti-layout-grid fs-8"></i>
                    </span>
                    <h4 class="card-title mt-3 mb-0 text-white">{{$problemTypeCount}}</h4>
                    <p class="card-text text-white opacity-75 fs-3 fw-normal">
                        Problem Types
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection



{{-- @section('datatablejs')
    <script src="{{ asset('dashbord/assets/datatable/js/jquery-3.6.0.min.js') }}""></script>
    <script src="{{ asset('dashbord/assets/datatable/js/datatables.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashbord/assets/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashbord/assets/datatable/js/custom.js') }}"></script>
@endsection --}}
