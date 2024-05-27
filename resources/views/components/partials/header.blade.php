


    <header class="topbar">
      <nav class="navbar navbar-expand-lg p-0">
        <div class="container-fluid">
          <ul class="navbar-nav d-flex flex-row align-items-center w-100">
            <li class="nav-item nav-icon-hover-bg rounded-circle ms-n2">
              <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
           

            <li class="nav-item nav-icon-hover-bg rounded-circle ms-2">
              <a id="theme-toggle" class="nav-link" href="javascript:void(0)">
                  <i id="theme-icon" class="fa"></i>
              </a>
            </li>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
              <ul class="navbar-nav d-flex flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- <img src="{{ asset('images/image.png') }}" alt="" width="35" height="35" class="rounded-circle"> --}}
                    <i class="fa-regular fa-user"></i>                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                      <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <p class="mb-0 fs-3">Hi {{ auth()->user()->name }}</p>
                      </a>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                          {{ __('Log Out') }}
                        </x-dropdown-link>
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </ul>
        </div>
      </nav>
    </header>
    