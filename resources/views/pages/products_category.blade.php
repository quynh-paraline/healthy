@extends("pages.layouts.layout")
@section("main")
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{$category->name}}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Pages</a></li>
            <li class="breadcrumb-item active text-white">{{$category->name}}</li>
        </ol>
    </div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">

                        </div>
                        <div class="col-6"></div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            @include("pages.shop.aside")
                        </div>

                        @include("pages.shop.products")

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
