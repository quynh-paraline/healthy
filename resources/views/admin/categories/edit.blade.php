@extends("admin.layouts.layout")
@section("main")
    <div class="row" style="margin-left: 250px">
        <form action="{{url("/admin/categories/update",["category"=>$category->id])}}" method="post"
              enctype="multipart/form-data" style="margin-top: 50px">
            @csrf
            <div class="form-group">
                <div class="form-create">
                    <label for="exampleFormControlInput1">Name</label>
                    <input name="name" type="text" class="form-control" placeholder="" value="{{$category->name}}"
                           style="width: 300px">
                </div>
                <br>

                <div class="form-group" style="margin-top: 100px">
                    <label for="exampleFormControlFile1">Thumbnail</label>
                    @if($category->thumbnail)
                        <img src="{{ $category->thumbnail }}" alt="Thumbnail" style="width: 80px;">
                        <u>  {{ $category->thumbnail }}</u>
                    @endif
                    <input type="file" name="thumbnail" class="form-control-file" value="{{$category->thumbnail}}"
                           id="exampleFormControlFile1">
                </div>

                <div class="form-group" style="margin-top: 50px">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
<style>
    form {
        width: 400px;
        float: none;
        margin: auto;
        border: #2b3e50 solid 0.25px;
        padding-left: 50px;
        padding-top: 50px;
        padding-bottom: 50px;
        border-radius: 10px;
    }

    .form-create {
        float: left;
        margin-right: 100px;
    }

    .form-group button {
        height: 40px;
        width: 100px;
        margin-left: 100px;
    }
</style>
