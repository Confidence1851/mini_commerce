@extends("dashboards.admin.layouts.app")
@section('content')

    <div id="tableCheckbox" class="">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Edit Category</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form enctype="multipart/form-data" class="form-row"
                    action="{{ route('admin.blog.category.update', $category->id) }}" method="POST"> @csrf @method("PUT")
                    <div class="form-group col-md-3">
                        <label for="">Cover Image <span class="required">*</span></label>
                        <input class="form-control" type="file" name="cover_image">
                    </div>

                    <div class="form-group col-md-9">
                        <label for="">Name <span class="required">*</span></label>
                        <input class="form-control" type="text" required name="name" value="{{ $category->name }}"
                            placeholder="Technology">
                    </div>


                    <div class="form-group col-md-4">
                        <label for="">Is Trending <span class="required">*</span></label>
                        <select name="is_trending" class="form-control" id="" required>
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($boolOptions as $key => $value)
                                <option value="{{ $key }}" {{ $key == $category->is_trending ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="">Is Active <span class="required">*</span></label>
                        <select name="is_active" class="form-control" id="" required>
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($boolOptions as $key => $value)
                                <option value="{{ $key }}" {{ $key == $category->is_active ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="">Show on User Dashboard <span class="required">*</span></label>
                        <select name="show_on_dashboard" class="form-control" id="" required>
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($boolOptions as $key => $value)
                                <option value="{{ $key }}" {{ $key == $category->show_on_dashboard ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="">Accessible Plans <span class="required">*</span></label>
                        <input class="form-control" type="text" required name="accessible_plans"
                        value="{{ $category->accessible_plans }}" placeholder="Bronze,Silver,Gold" >
                    </div>




                    <div class="form-group col-12">
                        <button class="btn btn-primary btn-lg">Submit</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
