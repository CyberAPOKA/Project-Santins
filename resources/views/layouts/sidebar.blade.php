<body id="body-pd">
    <header class="header" id="header">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        @if ($user->role == 0 and Route::is('universidades.index') || Route::is('universidades.search') || Route::is('home.role'))
            <div class="col-md-8">
                <form action="{{ route('universidades.search') }}" method="POST" class="search">
                    @csrf
                    <input type="text" id="search" name="search" placeholder="Search">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
        @endif

        @if (Route::is('universidades.create'))
            <div class="col-md-8">
                <div class="text-center">
                    <h1>Create your university</h1>
                </div>
            </div>
        @endif

        @if (Route::is('universidades.subscriptions') || Route::is('universidades.searchEnrollments'))
            <div class="col-md-8">
                <form action="{{ route('universidades.searchEnrollments') }}" method="POST" class="search">
                    @csrf
                    <input type="text" id="search" name="search" placeholder="Search">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>a</button>
                </form>
            </div>
        @endif

        @if ($user->role == 1 and Route::is('home.role') || Route::is('universidades.searchAdmin'))
            <div class="col-md-8">
                <form action="{{ route('universidades.searchAdmin') }}" method="POST" class="search">
                    @csrf
                    <input type="text" id="search" name="search" placeholder="Search">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
        @endif


        <div class="dropdown" style="float:right;">
            <button class="dropbtn" style="display: block; visibility:hidden"></button>
            @if ($user->role == 0)
                <div class="header_img"> <img src="{{ asset('assets/imgs/avatar-user.jpg') }}" alt=""></div>
            @else
                <div class="header_img"> <img src="{{ asset('assets/imgs/avatar-admin.jpg') }}" alt=""></div>
            @endif
            <div class="dropdown-content">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" class="dropdown-button-logout">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>

    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Santins</span> </a>
                <div class="nav_list">

                    @if ($user->role == 1)
                        <a href="{{ route('home.role') }}"
                            class="nav_link {{ request()->is('home') || request()->is('universidades/admin/search')  ? 'active' : '' }}">
                            <i class='bx bx-layer nav_icon'></i>
                            <span class="nav_name">ADMIN</span> </a>
                    @endif

                    @if ($user->role == 0)
                        <a href="{{ route('universidades.index') }}"
                            class="nav_link {{ request()->is('universidades') || request()->is('home') || request()->is('universidades/search') ? 'active' : '' }}">
                            <i class="fa-solid fa-building-columns nav_icon"></i>
                            <span class="nav_name">Universities</span> </a>
                    @endif
                    <a href="{{ route('universidades.create') }}"
                        class="nav_link {{ request()->is('universidades/create') ? 'active' : '' }}">

                        <i class="fa-solid fa-plus nav_icon"></i>
                        <span class="nav_name2">Create university</span> </a>
                    @if ($user->role == 0)
                        <a href="{{ route('universidades.subscribe') }}"
                            class="nav_link {{ request()->is('universidades/subscribe') ? 'active' : '' }}">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name3">My subscriptions</span> </a>
                    @endif
                    @if ($user->role == 1)
                        <a href="{{ route('universidades.subscriptions') }}"
                            class="nav_link {{ request()->is('universidades/subscriptions') || request()->is('universidades/subscriptions/search') ? 'active' : '' }}">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name3">All subscriptions</span> </a>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="nav_link">

                    <button type="submit" style="background: 0%; border:0ch; color: #afa5d9">
                        <i class='bx bx-log-out nav_icon' style="padding-right: 0.5em"></i>
                        {{ __('Log Out') }}
                    </button>
                </div>
            </form>

        </nav>
    </div>
