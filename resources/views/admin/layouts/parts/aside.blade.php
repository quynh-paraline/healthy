<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light"
              style="text-align: center;margin-left: 10px">Admin Healthy Food</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info" style="margin-bottom: 30px">
                <a href="#" class="d-block"> @guest
                        @if (Route::has('login'))

                            <a class="btn btn-primary" style="margin-left: 5px;margin-right: 5px"
                               href="{{ route('admin.login') }}">{{ __('Login') }}</a>

                        @endif

                        @if (Route::has('register'))
                            <a class="btn btn-success" href="{{ route('admin.register') }}">{{ __('Register') }}</a>

                        @endif
                    @else

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    @endguest
                </a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2" style="margin-top: 150px">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="/admin" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/orders/index" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/categories/index" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/products/index" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/users/index" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Members
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/administrators/index" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Administrators
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
