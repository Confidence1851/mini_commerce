<div class="modal fade" id="editCategoryModal_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="addNewCategoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route("admin.product-categories.update" , $category->id )}}" method="POST" enctype="multipart/form-data"> @csrf @method("put")
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Parent Category</label>
                        <select class="form-control" name="category_id">
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($categories as $_category)
                            <option value="{{ $_category->id }}" {{$category->category_id == $_category->id ? "selected" : ""}}>{{ $_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input class="form-control" name="name" placeholder="Eg. Livestock" value="{{$category->name}}"/>
                    </div>
                    <div class="form-group">
                        <label for="">Cover Image</label>
                        <input class="form-control" type="file" required name="image"/>
                    </div>
                    <div class="form-group">
                        <label for="">Status<span class="required">*</span></label>
                        <select name="status" class="form-control" id="" required>
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($statusOptions as $key => $value)
                            <option value="{{ $key }}" {{ $key == $category->status ? 'selected' : '' }}>
                                {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
