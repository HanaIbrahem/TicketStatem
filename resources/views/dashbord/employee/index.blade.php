@extends('dashbord.layout.master')


@section('main')
    {{-- <div class="row bg-white">
        <div class="col-12">
            <div class="card">
                <h3>Hi {{auth()->user()->name}}</h3>
            </div>
        </div>
    </div> --}}

    <style>
        .mycard{
            background-color: #d7e8ee;
            color: white;
        }
    </style>

    <div class="bg-white row">
        <div class="col-12">
            <p><h4 class="text-primary">Recent Tickets</h4></p>
            <div class="table-responsive rounded-4">
                <table class="table">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>#</th>
                            <th>From</th>
                            <th>Problem</th>
                            <th>Solution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nigam</td>
                            <td>Eichmann</td>
                            <td>@Sonu</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Deshmukh</td>
                            <td>Prohaska</td>
                            <td>@Genelia</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Roshan</td>
                            <td>Rogahn</td>
                            <td>@Hritik</td>
                        </tr>
                    </tbody>
                </table>
                </div>
        </div>
    </div>

    <div class="row bg-light">

        <div class="col-md-6">
            <div class="card rounded text-white mycard" >
                <div class="card-body">
                  
                    <h4 class="card-title">
                      Featured Hydroflora Pots Garden &amp; Outdoors
                    </h4>
                    <p class="mb-0 card-subtitle">
                      Titudin venenatis ipsum ac feugiat. Vestibulum ullamcorper quam.
                    </p>

                    <div class="d-flex align-items-center mb-3">
                        <span class="d-flex align-items-center">
                          <i class="ti text-success ti-calendar me-1 fs-5"></i> 20 May
                          2024
                        </span>
                        <div class="ms-auto">
                       
                            <span class="d-flex align-items-center">
                                <i class="ti text-danger ti-calendar me-1 fs-5"></i> 20 May

                            </span>
                        </div>
                    </div>
                
                  </div>
            </div>
        </div>

        
    
    </div>
    
@endsection