@extends("dashboards.admin.layouts.app")
@section('content')
<div class="row mt-4">
    <div class="col-12 mb-2">
        <h4>
           Create Product
        </h4>
    </div>
    <div class="col-md-12">
        <div id="tableCheckbox" class="">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Enter Product Details </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{ route("admin.products.store") }}" method="post">
                        @csrf
                        <div class="form-row mb-3">

                            <div class="form-group col-md-6">
                                <label for="">Category<span class="required">*</span></label>
                                <select name="category_id" class="form-control" id="" required>
                                    <option value="" disabled selected>Select Option</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group col-md-6">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="E.g. Television" value="{{$product->name}}" required />
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">Description</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Describe the products to the customers">{{$product->description}}</textarea>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Price (NGN)</label>
                                <input type="number" class="form-control" name="price" placeholder="E.g. 1000" value="{{$product->price}}" required />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Discount (NGN)</label>
                                <input type="number" class="form-control" name="discount" placeholder="E.g. 100" value="{{$product->discount}}" />
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Status<span class="required">*</span></label>
                                <select name="status" class="form-control" id="" required>
                                    <option value="" disabled selected>Select Option</option>
                                    @foreach ($statusOptions as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $product->status ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
