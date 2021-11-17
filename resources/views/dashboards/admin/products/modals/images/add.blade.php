<div class="modal fade" id="addNewImageModal" tabindex="-1" role="dialog" aria-labelledby="addNewImageModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route("admin.product-images.store") }}" method="POST" enctype="multipart/form-data"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" value="{{$product->id}}" name="product_id" required>
                    <div class="form-group">
                        <label for="">Image <span class="required">*</span></label>
                        <input class="form-control" type="file" required name="image">
                    </div>

                    <div class="form-group">
                        <label for="">Is Default <span class="required">*</span></label>
                        <select name="is_default" class="form-control" id="" required>
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($boolOptions as $key => $value)
                            <option value="{{ $key }}">
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
