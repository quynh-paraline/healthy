@extends("web.layouts.main")
@include("web.layouts.parts.slide")

@php
    use Illuminate\Support\Str;
@endphp

@section("main")
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a href="#tab-1">
                                <p class="text-dark" style="width: 130px;">All Products</p>
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li class="nav-item">
                            <a href="{{url("/filter",["category"=>$category->id])}}" >
                                <p class="text-dark" style="width: 130px;">{{$category->name}}</p>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach($products as $item)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item" style="min-width: 315px">
                                            <div class="fruite-img">
                                                <img src="{{$item->thumbnail}}" class="img-fluid w-100 rounded-top"
                                                     style="min-height: 250px;max-height: 250px" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                 style="top: 10px; left: 10px;">
                                                {{$item->category->name}}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{$item->name}}</h4>
                                                <p>{{Str::limit($item->description,50) }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">${{$item->price}}/kg</p>
                                                    <a href="{{url("/carts/add",["product"=>$item->id])}}"
                                                       class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
