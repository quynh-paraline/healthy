@php
    use Illuminate\Support\Str;
@endphp
<div class="col-lg-9">
    <div class="row g-4 justify-content-center">
        @foreach($products as $item)
            <div class="col-md-6 col-lg-6 col-xl-4">
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
                        <p>{{Str::limit($item->description,70)}}</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">${{$item->price}}/kg</p>
                            <a href="{{url("/carts/add",["product"=>$item->id])}}"
                               class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-12">
            <div class="paginate">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            {!! $products->links("pagination::bootstrap-4") !!}
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<style>
    .paginate .pagination {
        display: flex;
        justify-content: center;
    }
</style>
