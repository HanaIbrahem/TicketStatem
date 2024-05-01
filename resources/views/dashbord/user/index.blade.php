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
                Users
            </h3>
            <a class="btn btn-primary" href="{{ route("dashbord.user.create") }}">
                New
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table id="example" class="table">
                    <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                       
                        <th>
                            Username
                        </th>
    
                        <th>
                            CreatedAt
                        </th>
                        <th>
                            Role 
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        
                        @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
    
                            <td>
                                {{ $user->username }}
                            </td>
                            
                            <td>
                                 {{ $user->created_at}}
                            
                            </td>
                          
                            <td>
                               {{ $user->role}}
                            </td>
                            <td>
                                <x-status :status="$user->is_active"></x-status>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route("dashbord.user.edit",$user->id) }}">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route("dashbord.user.state",$user->id)  }}">
                                                @if($user->is_active)
                                                    Deactivate
                                                @else
                                                    Activate
                                                @endif
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
