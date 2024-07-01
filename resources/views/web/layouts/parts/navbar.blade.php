<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                                                                                                 class="text-white">123
                        Street, New York</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{route("web.welcome")}}" class="navbar-brand"><h1 class="text-primary display-6">Healthy-foods</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{route("web.welcome")}}" class="nav-item nav-link">Home</a>
                    <a href="{{route("web.shop")}}" class="nav-item nav-link">Shop</a>
                    <a href="{{route("web.carts.index")}}" class="nav-item nav-link">Cart</a>
                    <a href="{{route("web.contact")}}" class="nav-item nav-link">Contact</a>
                    <a href="{{route("web.orders.index")}}" class="nav-item nav-link">Invoice</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    <a href="/carts/index" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        @if(session("cart")==0)
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">0</span>
                        @else
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{count(session("cart"))}}</span>
                        @endif
                    </a>
                    <a href="#" class="my-auto">
                        @guest
                            @if (Route::has('web.login'))

                                <a class="btn btn-primary" style="margin-left: 5px;margin-right: 5px"
                                   href="{{ route('web.login') }}">{{ __('Login') }}</a>

                            @endif

                            @if (Route::has('web.register'))
                                <a class="btn btn-success" href="{{ route('web.register') }}">{{ __('Register') }}</a>

                            @endif
                        @else

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('web.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('web.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        @endguest
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>


<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <form action="/shop" method="get" style="height: 60px;width: 590px;margin-left: 250px">
                        <input style="width: 505px" type="search" class="form-control p-3" name="content"
                               placeholder="Search by keyword"
                               value="{{app("request")->input('content')}}"
                               aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"
                              style="float: right;height: 57.6px;margin-top: -57.6px;background-color: #81c408 ">
                                    <button type="submit"
                                            style="width: 50px;height: 50px;border: 0 solid;background-color: #81c408 ">
                                        <i class="fa fa fa-search" style="background-color: #81c408 "></i>
                                    </button>
                                </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->
