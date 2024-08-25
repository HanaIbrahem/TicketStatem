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
 

        <div class="col-6">
            <h2>Export Database</h2>
            <a href="{{route('dashbord.setting.export')}}" class="btn m-2 p-1">
                <i class="fa-solid fa-database text-danger fs-4 m-1"></i>Export</a>
        </div>
        <div class="col-6">
            <h2>Backup Database</h2>
            <a href="{{route('dashbord.setting.backup')}}" class="btn m-2 p-1">
                <i class="fa-solid fa-database text-danger fs-4 m-1"></i>Backuo</a>
        </div>
        @foreach ($files as $file)
                    <tr>
                        <td>{{ basename($file) }}</td>
                        <td>
                            <a href="{{ route('dashbord.backups.download', basename($file)) }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endforeach
    @if (session('message'))
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('message') }}<br>
                    Filename: {{ session('filename') }}
                </div>
            </div>
        @endif
    </div>
@endsection