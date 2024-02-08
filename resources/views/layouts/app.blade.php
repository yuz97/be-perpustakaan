@include('layouts.parts.header')
@stack('css')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        @include('layouts.parts.sidebar')


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize">{{
                                    Auth::user()->name
                                    }}</span>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <form action="{{ route('logout') }}" method="post" id="logout-form">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="javascript:void(0)"
                                    onclick="(e) => e.preventDefault();document.querySelector('#logout-form').submit()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    @yield('content')
                    @yield('modal')

                </div>

            </div>
            <!-- End of Main Content -->


            @include('layouts.parts.footer')
            @stack('script')