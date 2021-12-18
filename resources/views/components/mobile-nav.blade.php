
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">Close &times;</a>
        <ul class="prcClass">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <span class="mr-2 d-lg-inline text-white nav-menu-size">Home</span>
                </a>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link" href="javascript:showSv()" id="userDropdown" role="button">
                    <span class="mr-2 d-lg-inline text-white nav-menu-size">Services</span>
                </a>
            </li>
            <li class="nav-item services-sub submenu">
                <a class="nav-link" href="{{ route('service') }}">
                    <span class="mr-2 d-lg-inline text-white nav-menu-size">All Services</span>
                </a>
            </li>
            @if($services->count() > 0)
                @foreach($services as $service)
                <li class="nav-item services-sub submenu">
                    <a class="nav-link" href="{{ route('service', ['category'=>$service->id]) }}">
                        <span class="mr-2 d-lg-inline text-white nav-menu-size">{{ $service->name }}</span>
                    </a>
                </li>
                @endforeach
            @endif
            <li class="nav-item">
                <a class="nav-link" href="javascript:showEv()" id="userDropdown" role="button">
                    <span class="mr-2 d-lg-inline text-white nav-menu-size">Events</span>
                </a>
            </li>
            <li class="nav-item event-sub submenu">
                <a class="nav-link" href="{{ route('event') }}">
                    <span class="mr-2 d-lg-inline text-white nav-menu-size">All Events</span>
                </a>
            </li>
            @if($events->count() > 0)
                @foreach($events as $event)
                    <li class="nav-item event-sub submenu">
                        <a class="nav-link" href="{{ route('event', ['category'=>$event->id]) }}">
                            <span class="mr-2 d-lg-inline text-white nav-menu-size">{{ $event->name }}</span>
                        </a>
                    </li>
                @endforeach
            @endif
            {{-- Check if user is logged in --}}

            @if (Auth::check())
                <li class="nav-item">
                    @if(auth()->user()->isAdmin())
                        <a class="nav-link" href="{{ route('admin.dashaboard') }}">
                            <span class="mr-2 d-lg-inline text-white nav-menu-size">Dashboard</span>
                        </a>
                    @endif
                    @if(auth()->user()->isVendor())
                        <a class="nav-link" href="{{ route('vendor.dashboard') }}">
                            <span class="mr-2 d-lg-inline text-white nav-menu-size">Dashboard</span>
                        </a>
                    @endif
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <span class="mr-2 d-lg-inline text-white nav-menu-size">Logout</span>
                    </a>
                </li>

            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <span class="mr-2 d-lg-inline text-white nav-menu-size">Login</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        <span class="mr-2 d-lg-inline text-white nav-menu-size">Register</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
