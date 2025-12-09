<!-- fixed-top Navbar -->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a>
                </li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="brand-logo" alt="Playvibe logo" src="{{asset('assets/dashboard/images/logo/logoNew.png')}}">
                        <h3 class="brand-text">PlayVibe</h3>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block float-right">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white"></i></a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>

        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <!-- Left side -->
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a>
                    </li>
                    <li class="nav-item nav-search">
                        <a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text" placeholder="Explore Modern...">
                        </div>
                    </li>
                </ul>

                <!-- Right side -->
                <ul class="nav navbar-nav float-right">
                    <!-- Notifications Dropdown -->
                    @if(auth()->check())
                    <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ auth()->user()->unreadNotifications->count() }}</span>
              </a>

                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
                                <span class="notification-tag badge badge-danger float-right m-0">{{ auth()->user()->unreadNotifications->count() }} New</span>
                            </li>

                            <li class="scrollable-container media-list w-100">
                                @forelse(auth()->user()->notifications as $note)
                                    <a class="d-flex dropdown-item" href="/admin/orders/{{ $note->data['order_id'] }}">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-bell warning font-medium-3"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">{{ $note->data['client_name'] }} placed an order</h6>
                                                <p class="notification-text font-small-3 text-muted">Total: {{ $note->data['subtotal']}}</p>
                                                <small><time class="media-meta text-muted" datetime="{{ $note->created_at }}">{{ $note->created_at->diffForHumans() }}</time></small>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <span class="dropdown-item">No notifications</span>
                                @endforelse
                            </li>

                            <li class="dropdown-menu-footer">
                                <a class="dropdown-item text-muted text-center" href="javascript:void(0)" onclick="document.getElementById('markAllRead').submit();">Mark all as read</a>
                                <form id="markAllRead" action="{{ route('admin.notifications.read-all') }}" method="POST">@csrf</form>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <!-- Profile Dropdown -->
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">Hello,
                                <span class="user-name text-bold-700">{{ Auth::user()->first_name ?? 'Guest' }}</span>
                            </span>
                            <span class="avatar avatar-online">
                                <img src="{{asset('assets/dashboard/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="ft-user"></i> Edit Profile</a>
                            <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a>
                            <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="if(confirm('Are you sure?')){document.getElementById('formLogout').submit()}return false"><i class="ft-power"></i> Logout</a>
                            <form id="formLogout" action="{{ route('logout') }}" method="POST">@csrf</form>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>
