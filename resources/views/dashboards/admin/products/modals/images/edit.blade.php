<div class="modal fade" id="editImageModal_{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="editImageModal_{{$image->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route("admin.product-images.update" , $image->id) }}" method="POST" enctype="multipart/form-data"> @csrf @method("put")
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="{{ $image->url() }}" target="_blank">
                        <img src="{{ $image->url() }}" class="img-fluid">
                    </a>
                    <input type="hidden" value="{{$product->id}}" name="product_id" required>
                    <div class="form-group">
                        <label for="">Image <span class="required">*</span></label>
                        <input class="form-control" type="file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="">Is Default <span class="required">*</span></label>
                        <select name="is_default" class="form-control" id="" required>
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($boolOptions as $key => $value)
                            <option value="{{ $key }}" {{$key == $image->is_default ? "selected" : ""}}>
                                {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" onclick='return $("#delete_image_{{$image->id}}").trigger("submit");' >
                        <i class="fa fa-trash"></i> Delete</button>
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            <form action="{{ route("admin.product-images.destroy" , $image->id)}}" id="delete_image_{{$image->id}}" method="post">@csrf @method("delete")</form>
        </div>
    </div>
</div>
