@extends('dashbord.layout.master')
@php
    $no=1;
@endphp
@section('datatablecss')
<link rel="stylesheet" href="{{asset('dashbord/assets/datatable/css/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('dashbord/assets/datatable/css/style.css')}}">

@endsection

@section('main')
<div class="row">
    <div class="col-12">
        <!-- ----------------------------------------- -->
        <!-- 1. Basic Form -->
        <!-- ----------------------------------------- -->
        <!-- start Basic Form -->
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-3">Add Place or Person</h4>
            <form action="{{route('dashbord.requestfrom.store')}}" method="POST">
             @csrf
             @method('POST')
              <div class="row">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" required name="title" class="form-control" id="tb-fname" placeholder="Enter Name here">
                    <label for="tb-fname">Title</label>
                  </div>
                </div>
    
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input class="btn btn-primary" type="submit" value="Save">
                    </div>
                </div>
             
              
                
                
              
              </div>
            </form>
          </div>
        </div>
        <!-- end Basic Form -->
    </div>
</div>

<div class="row">

    <div class="card">
        <div class="card-header">
            <h3>
                Place Or Person List
            </h3>
          
        </div>

        <div class="card-body ms-0 ps-0">
            <div class="table-responsive">
                <table id="example" class="table">
                    <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            TItle
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
                    <tbody>
                    
                        
                        @foreach($places as $place)
                        <tr>
                            <td>
                                {{ $no++ }}
                            </td>
                            <td>
                                {{ $place->title }}
                            </td>
    
                           
                            
                            <td>
                                 {{ $place->created_at}}
                            
                            </td>
                          
                            <td>
                                <x-status :status="$place->is_active"></x-status>
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
                                               href="{{ route("dashbord.requestfrom.edit",$place->id) }}">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route("dashbord.requestfrom.state",$place->id)  }}">
                                                @if($place->is_active)
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
