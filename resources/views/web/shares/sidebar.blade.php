<br>
<div class="row g-4">
    <div class="col-lg-12">
        <div class="mb-3">
            <h4>Categories</h4>
            @foreach($categories as $category)
                <ul class="list-unstyled fruite-categorie">
                    <li>
                        <div class="d-flex justify-content-between fruite-name">
                            <a href="{{url("/filter",["category"=>$category->id])}}"><i
                                    class="fas fa-apple-alt me-2"></i>{{$category->name}}</a>
                            <span>({{$category->products->count()}})</span>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
    <div class="col-lg-12">
        <div class="position-relative">
            <img src="/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
            </div>
        </div>
    </div>
</div>
