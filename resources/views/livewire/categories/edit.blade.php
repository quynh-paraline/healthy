<div>
    <div class="row" style="margin-left: 250px">
        <form wire:submit.prevent="update"
              style="margin-top: 50px">
            <div class="form-group">
                <div class="form-create">
                    <label for="exampleFormControlInput1">Name</label>
                    <input wire:model="name" type="text" class="form-control" placeholder=""
                           style="width: 300px">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <br>

                <div class="form-group" style="margin-top: 100px">
                    <label for="exampleFormControlFile1">Thumbnail</label>
                    @if($thumbnail)
                        <img src="{{ $thumbnail }}" alt="Thumbnail" style="width: 80px;">
                        <u>  {{ $thumbnail }}</u>
                    @endif
                    <input type="file" wire:model="newThumbnail" class="form-control-file"
                           id="exampleFormControlFile1">
                    @error('newThumbnail') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-top: 50px">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </form>
    </div>

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
</div>
