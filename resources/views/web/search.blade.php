@extends("web.layouts.layout")
@section("main")
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Search : {{app("request")->input('content')}}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <form action="/search" method="get" style="height: 60px;width: 290px">
                                    <input style="width: 205px" type="search" class="form-control p-3" name="content"
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
                        <div class="col-6"></div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            @include("web.shares.sidebar")
                        </div>

                        @if($products->count() >=1)

                            @include("web.shares.products")

                        @else
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                                    <h2 style="text-align: center;color: #898a8c">Can't products found with the name:
                                        " {{app("request")->input('content')}} " !</h2>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
