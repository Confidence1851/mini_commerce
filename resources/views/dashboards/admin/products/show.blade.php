@extends("dashboards.admin.layouts.app")
@section('content')

<div class="row">
    <div class="col-md-7">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <form action="{{ route("admin.products.destroy" , $product->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method("delete")
                            <h4>Product Details
                                <span class="fr">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete Product</button>
                                </span>
                            </h4>
                        </form>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="mb-2">
                    <b>Category</b> : {{optional($product->category)->name ?? "N/A" }}
                </div>
                <div class="mb-2">
                    <b>Name</b> : {{$product->name }}
                </div>
                <div class="mb-2">
                    <b>Unique Reference</b> : {{$product->reference }}
                </div>
                <div class="mb-2">
                    <b>Description</b> : {{$product->description }}
                </div>

                <hr>


                <div class="mb-2">
                    <b>Price</b> : {{ format_money($product->price)}}
                </div>
                <div class="mb-2">
                    <b>Discount</b> : {{ format_money($product->discount)}}
                </div>
                <div class="mb-2">
                    <b>Status</b> : {{$product->status }}
                </div>

                <hr>
                <div class="mb-2">
                    <b>Total Views</b> : {{$product->total_views }}
                </div>
                <div class="mb-2">
                    <b>Total Orders</b> : <a href="{{ route("admin.products.orders" , $product->id)}}" class="btn">
                        {{$product->total_orders }}
                    </a>
                </div>

            </div>
        </div>

    </div>

    <div class="col-md-5">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Images
                            <span class="fr">
                                <a data-target="#addNewImageModal" data-toggle="modal" class="btn btn-sm btn-success">Add</a>
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="form-row">
                    @foreach ($product->images as $image)
                    <div class="col-md-6 mb-3 {{$image->is_default ? "default_image" : ""}}">
                        <a data-toggle="modal" data-target="#editImageModal_{{$image->id}}">
                            <img src="{{ $image->url() }}" class="img-fluid">
                        </a>
                    </div>

                    @include("dashboards.admin.products.modals.images.edit")
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</div>
@include("dashboards.admin.products.modals.images.add")
@endsection
