<div>
    <div class="row" style="margin-left: 250px">
        <form wire:submit.prevent="update"
              style="margin-top: 50px">

            <div class="form-group">
                <div class="form-create" style="text-align: center">
                    <label for="exampleFormControlInput1">Name</label>
                    <input class="form-control" style="width: 250px;margin-left: 50px" type="text" wire:model="name" >
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-create" style="margin-left: 25px;text-align: center;margin-top: 20px">
                    <label for="exampleFormControlInput1">Password</label>
                    <input wire:model="password" type="password" class="form-control" placeholder="Leave blank if to keep current password" style="width: 300px">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-create"  style="margin-left: 25px;text-align: center;margin-top: 20px">
                    <label for="exampleFormControlInput1">Confirm Password</label>
                    <input wire:model="password_confirmation" type="password" class="form-control" placeholder="Confirm new password" style="width: 300px">
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group" style="margin: auto">
                <div class="form-create_2" style="text-align: center">
                    <label for="exampleFormControlInput1">Role</label>
                    <select wire:model="role" class="form-control" style="width: 150px;margin: auto">
                        <option value="0">Clients</option>
                        <option value="1">Orders Management</option>
                        <option value="2">Products Management</option>
                    </select>
                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>


            <div class="form-group">
                <button style="margin-left: 100px;margin-top: 50px;margin-bottom: -50px;width: 150px" type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <style>
        form {
            width: 450px;
            float: none;
            margin: auto;
            border: #c8c9c9 0.5px solid;
            padding: 50px;
            border-radius: 10px;
        }
    </style>
</div>
