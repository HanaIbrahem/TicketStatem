
<!DOCTYPE html>
<html lang="en">
  <x-partials.head/>

<body>
    
    <div id="main-wrapper" class="auth-customizer-none">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
          <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
              <div class="col-md-8 col-lg-4 col-xxl-3 auth-card">
                <div class="card mb-0">
                  <div class="card-body">
                    <a href="" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                      {{-- <img src="../assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark"> --}}
                      <img src="{{asset('logo-small.svg')}}" class="light-logo" alt="Logo-light">
                    </a>
                
                    <div class="position-relative text-center my-4">
                      <p class="mb-0 fs-4 px-3 d-inline-block bg-body text-dark z-index-5 position-relative">sign in
                      </p>
                      <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" action="{{route('loginrequest')}}">
                      @method('POST')
                      @csrf
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" required class="form-control" name="password" id="exampleInputPassword1">
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                          <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked="">
                          <label class="form-check-label text-dark" for="flexCheckChecked">
                            Remeber this Device
                          </label>
                        </div>
                        
                      </div>

                     
                  
                     
                      <input type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2" value="Sign in">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</body>
</html>
