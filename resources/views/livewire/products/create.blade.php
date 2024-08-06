<div>
<div class="row" style="margin-left: 250px">
    <form wire:submit.prevent="store"
          style="margin-top: 50px">

        <div class="form-group">
            <div class="form-create">
                <label for="exampleFormControlInput1">Name</label>
                <input wire:model="name" type="text" class="form-control" placeholder="" style="width: 300px">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-create">
                <label for="exampleFormControlInput1">Price</label>
                <input  wire:model="price" type="number" min="0" class="form-control" placeholder="" style="width: 150px">
                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 100px">
            <label for="exampleFormControlFile1">Thumbnail</label>
            <input type="file"  wire:model="thumbnail" class="form-control-file" id="exampleFormControlFile1">
            @error('thumbnail') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <div class="form-create_2"><label for="exampleFormControlInput1">Qty</label>
                <input wire:model="qty" type="number" min="0" class="form-control" placeholder="" style="width: 150px">
                @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-create_2"><label for="exampleFormControlInput1">Category</label>
                <select wire:model="category_id" class="form-control" style="width: 150px">
                    @foreach($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select></div>
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group" style="margin-top: 100px">
            <label for="exampleFormControlInput1">Description</label>
            <textarea style="height: 200px" class="form-control" wire:model="description"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
<style>
    form {
        width: 700px;
        float: none;
        margin: auto;

    }

    .form-create {
        float: left;
        margin-right: 100px;
    }

    .form-create_2 {
        float: left;
        margin-right: 50px;
    }

</style>
</div>
