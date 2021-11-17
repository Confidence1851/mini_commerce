@extends("dashboards.admin.layouts.app")
@section('content')

<div class="statbox widget box box-shadow mt-5">
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4 class="p-2">Products
                    <span class="fr">
                        <a href="{{ route("admin.products.create")}}" class="btn btn-success">New Product</a>
                    </span>
                </h4>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area">
        <div class="table-responsive">
            <table class="table table-bproducted table-hover table-striped table-checkable table-highlight-head mb-4">
                <thead>
                    <th>SN</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Reference</th>
                    <th>Category</th>
                    <th>Views</th>
                    <th>Ordered</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>

                        <td>{{$sn++}}</td>
                        <td><img src="{{ $product->getDefaultImage() }}" alt="{{$product->name}}" width="100"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->reference }}</td>
                        <td>{{ optional($product->category)->name ?? "N/A" }}</td>
                        <td>{{ $product->total_views }}</td>
                        <td>{{ $product->total_orders }}</td>
                        <td>{{ format_money($product->price , 2) }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ date('Y-m-d', strtotime($product->created_at)) }}</td>
                        <td>
                           <form action="{{ route("admin.products.destroy" , $product->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method("delete")
                            <a href="{{ route("admin.products.show" , $product->id)}}">
                                <i data-feather="eye" class="text-warning mr-2"></i></a>
                            </a>
                            <a href="{{ route("admin.products.edit" , $product->id)}}">
                                <i data-feather="edit-2" class="text-info"></i></a>
                            </a>
                            <button type="submit" data-feather="trash-2" class="text-danger mt-3" onClick="$(this).parent().trigger('submit')"></button>
                        </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {!! $products->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>

@endsection
