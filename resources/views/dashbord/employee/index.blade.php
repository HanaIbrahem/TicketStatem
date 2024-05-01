@extends('dashbord.layout.master')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h3>Hi {{auth()->user()->name}}</h3>

            </div>
        </div>
    </div>
@endsection