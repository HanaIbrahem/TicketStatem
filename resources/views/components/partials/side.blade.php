   <!-- Sidebar Start -->

   @php
       use App\Models\Tickt;

       if (auth()->user()->role !== 'employee') {
           $ticketcount = Tickt::whereHas('user', function ($query) {
               $query->where('role', 'employee');
           })
               ->where('state', 'pending')
               ->orderBy('created_at', 'desc')
               ->count();
       }

   @endphp
   <aside class="left-sidebar">
       <!-- Sidebar scroll-->
       <div>
           <div class="brand-logo d-flex align-items-center justify-content-between">
               <a href="{{ route('dashbord.index') }}" class="text-nowrap logo-img">
                   <img src="{{ asset('logo-small.svg') }}" width="180" alt="" />
               </a>
               <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                   <i class="ti ti-x fs-8"></i>
               </div>
           </div>
           <!-- Sidebar navigation-->
           <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
               <ul id="sidebarnav">
                   <li class="nav-small-cap">
                       <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                       <span class="hide-menu">Home</span>
                   </li>


                   <li class="sidebar-item">
                       <a class="sidebar-link" href="{{ route('dashbord.index') }}" aria-expanded="false">
                           <span>
                               <i class="ti ti-layout-dashboard"></i>
                           </span>
                           <span class="hide-menu">Dashboard</span>
                       </a>
                   </li>


                   <li class="sidebar-item">
                       <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                           <span class="d-flex">
                               <i class="fa-solid fa-headset"></i>
                           </span>
                           <span class="hide-menu">Ticket</span>
                       </a>
                       <ul aria-expanded="false" class="collapse first-level in">
                           <li class="sidebar-item">
                               <a href="{{ route('dashbord.ticket') }}" class="sidebar-link">
                                   <div class="round-16 d-flex align-items-center justify-content-center">
                                       <i class="ti ti-circle"></i>
                                   </div>
                                   <span class="hide-menu">Ticket List</span>
                               </a>
                           </li>
                           <li class="sidebar-item">
                               <a href="{{ route('dashbord.ticket.create') }}" class="sidebar-link">
                                   <div class="round-16 d-flex align-items-center justify-content-center">
                                       <i class="ti ti-circle"></i>
                                   </div>
                                   <span class="hide-menu">Open Ticket</span>
                               </a>
                           </li>
                       </ul>
                   </li>


                   @if (auth()->user()->role !== 'employee')
                       <li class="sidebar-item">
                           <a class="sidebar-link" href="{{ route('dashbord.pending') }}" aria-expanded="false">


                               <div class="round-16 d-flex align-items-center justify-content-center">
                                   <i class="ti ti-clock"></i></div>

                               <span class="hide-menu">Pending Tecket

                                   @if ($ticketcount > 0)
                                       (<span class="text-warning">{{ $ticketcount }}</span>)
                                   @endif
                               </span>
                           </a>
                       </li>


                       <li class="sidebar-item">
                           <a class="sidebar-link" href="{{ route('dashbord.ticket.all') }}" aria-expanded="false">
                               <span>
                                   <i class="fa-solid fa-phone"></i>
                               </span>
                               <span class="hide-menu">Employee Teckets</span>
                           </a>
                       </li>


                   @endif

                   @if (auth()->user()->role === 'superadmin')
                       <li class="sidebar-item">
                           <a class="sidebar-link" href="{{ route('dashbord.requestfrom') }}" aria-expanded="false">
                               <span>
                                   <i class="ti ti-location"></i>
                               </span>
                               <span class="hide-menu">Request Place</span>
                           </a>
                       </li>

                       <li class="sidebar-item">
                           <a class="sidebar-link" href="{{ route('dashbord.problem') }}" aria-expanded="false">
                               <span>
                                   <i class="ti ti-tag"></i>
                               </span>
                               <span class="hide-menu">Problem Type</span>
                           </a>
                       </li>

                       <li class="sidebar-item">
                           <a class="sidebar-link" href="{{ route('dashbord.solution') }}" aria-expanded="false">
                               <span>
                                   <i class="fa fa-check"></i>
                               </span>
                               <span class="hide-menu">Solution</span>
                           </a>
                       </li>
                       <li class="sidebar-item">
                           <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                               <span class="d-flex">
                                   <i class="ti ti-user"></i>
                               </span>
                               <span class="hide-menu">Auth</span>
                           </a>
                           <ul aria-expanded="false" class="collapse first-level in">
                               <li class="sidebar-item">
                                   <a href="{{ route('dashbord.users') }}" class="sidebar-link">
                                       <div class="round-16 d-flex align-items-center justify-content-center">
                                           <i class="ti ti-circle"></i>
                                       </div>
                                       <span class="hide-menu">Users</span>
                                   </a>
                               </li>
                               <li class="sidebar-item">
                                   <a href="{{ route('dashbord.user.create') }}" class="sidebar-link">
                                       <div class="round-16 d-flex align-items-center justify-content-center">
                                           <i class="ti ti-circle"></i>
                                       </div>
                                       <span class="hide-menu">Regiser User</span>
                                   </a>
                               </li>
                           </ul>
                       </li>
                   @endif








               </ul>

           </nav>
           <!-- End Sidebar navigation -->
       </div>
       <!-- End Sidebar scroll-->
   </aside>
   <!--  Sidebar End -->
