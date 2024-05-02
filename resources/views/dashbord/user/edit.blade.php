@extends('dashbord.layout.master')

@section('main')
    

<div class="card">
    <div class="card-header">
        <h3>
            Edit User
        </h3>
    </div>
    <div class="card-body">

        <p>
            @if (count($errors))
            <div class="alert text-danger p-1">
                @foreach ($errors->all() as $message )
                    <p class="m-0 p-0">{{ $message}}</p>
                @endforeach
                </ul>
            </div>
            @endif
        </p>
        <form class="row" action="{{route('dashbord.user.update')}}" enctype="multipart/form-data" method="post">
           
           @csrf
           @method('POST')

           <input type="hidden" name="id" value="{{$user->id}}">
            <div class="col-6 mb-2"> 
                <label class="form-label" for="name">Name</label>
                <input type="text" required name="name" value="{{$user->name}}" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="col-6 mb-2"> 
                <label class="form-label" for="name">Username</label>
                <input type="text" required name="username" value="{{$user->username}}" class="form-control" id="username" placeholder="Username">
            </div>
            <div class="col-sm-6 mb-2"> 
                <label class="form-label" for="name">UserType</label>
           
                
                <select class="form-select mr-sm-2" name="userrole" id="inlineFormCustomSelect">
                    <option  class="mb-2" {{  $user->role === 'employee' ? 'selected' : ''}} value="employee">Employee</option>
                    <option  {{  $user->role === 'manager' ? 'selected' : ''}} value="manager">Manger</option>
                </select>

            </div>
          
            <div class="col-12 mt-3 text-end">
                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                    Update
                </button>
            </div>

        </form>


        
      
        <div class="row mb-4">
            <h3>
                Update Password
            </h3>
        </div>
        <form class="row" action="{{route('dashbord.user.pass')}}" method="post">

            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{$user->id}}">

            <div class="col-sm-6 mb-2"> 
                <label class="form-label" for="name">Password</label>
                <input type="password" required name="password" class="form-control" id="password" placeholder="Password">
            </div>

            <div class="col-sm-6 mb-2"> 
                <label class="form-label" for="name">Confirm Password</label>
                <input type="password" required  name="password_confirmation"  autocomplete="new-password" class="form-control" id="confirm" placeholder="Confirm">
            </div>

            <div class="col-12 mt-3 text-end">
                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection