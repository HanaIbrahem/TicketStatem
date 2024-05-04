@extends('dashbord.layout.master')


@section('main')
    {{-- <div class="row bg-white">
        <div class="col-12">
            <div class="card">
                <h3>Hi {{auth()->user()->name}}</h3>
            </div>
        </div>
    </div> --}}


    <div class="row">
        <div class="col-12">
            <!-- 5. card with background -->
            <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
                <h4 class="mb-0 fs-5">Your Dashbord</h4>
            </div>
        </div>

        <div class="col-lg-4 col-xxl-2 col-12">
            <div class="card text-white text-bg-primary">
                <div class="card-body p-4">
                    <span>
                        <i class="ti ti-layout-grid fs-8"></i>
                    </span>
                    <h4 class="card-title mt-3 mb-0 text-white">{{ $totalTicketsCount }}</h4>
                    <p class="card-text text-white opacity-75 fs-3 fw-normal">
                        Tickets
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
                    <h4 class="card-title mt-3 mb-0 text-white">{{ $pendingTicketsCount }}</h4>
                    <p class="card-text text-white opacity-75 fs-3 fw-normal">
                        Pending Teckets
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-secondary">
                <div class="card-body p-4">
                    <span>
                        <i class="ti ti-layout-grid fs-8"></i>
                    </span>
                    <h4 class="card-title mt-3 mb-0 text-white">{{ $openTicketsCount }}</h4>
                    <p class="card-text text-white opacity-75 fs-3 fw-normal">
                        Open Tickets
                    </p>
                </div>
            </div>
        </div>

    </div>


    <div class="bg-white row">

        <div class="col-md-8">
            <p>
            <h4 class="text-primary">Recent Tickets</h4>
            </p>
            <div class="rounded-4">
                <div class="list-group has-scroll ">

                    @foreach ($recentTickets as $ticket )
                        
                    <a  href="{{route('dashbord.ticket.show',$ticket->id)}}" class="list-group-item" >
                       <span class="status-modern"><b>#{{$ticket->id}}</b> - {{ $ticket->issuetype}} on {{ $ticket->problemType->title }}  from {{ $ticket->requestFrom->title }} </span>
                        <p class="mb-0">
                            Solution: {{$ticket->solution->title}} 
                            <span class="status float-right" style="--status-color: #888888">
                            </span><br>
                            <small class="text-muted float-right">Last Updated: {{$ticket->updated_at->format('Y/M/d')}}  {{$ticket->dilivery}} Stete <x-statecheck :state="$ticket->state" /> </small>
                        </p>
                    </a>
                    
                    @endforeach
                    
                 
                </div>
            </div>
        </div>


    </div>
@endsection
