@extends('dashbord.layout.master')

@section('main')
<div class="row">
    <div class="col-12">
        <!-- ----------------------------------------- -->
        <!-- 1. Basic Form -->
        <!-- ----------------------------------------- -->
        <!-- start Basic Form -->
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-3">Add Problem</h4>
            <form action="{{route('dashbord.problem.update')}}" method="POST">
             @csrf
             @method('POST')
             <input type="hidden" value="{{$problem->id}}" name="id">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" required name="title" value="{{$problem->title}}" class="form-control" id="tb-fname" placeholder="Enter Name here">
                    <label for="tb-fname">Title</label>
                  </div>
                </div>
    
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </div>
             
              
                
                
              
              </div>
            </form>
          </div>
        </div>
        <!-- end Basic Form -->
    </div>
</div>




@endsection