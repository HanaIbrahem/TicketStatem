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
            <h2>Export Database</h2>
            <a href="{{route('dashbord.setting.export')}}" class="btn m-2 p-1">
                <i class="fa-solid fa-database text-danger fs-4 m-1"></i>Export</a>
        </div>

    </div>
@endsection