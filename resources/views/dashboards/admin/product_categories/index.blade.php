@extends("dashboards.admin.layouts.app")
@section('content')

<div class="statbox widget box box-shadow mt-5">
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2">
                <h4>Product Categories
                    <span class="fr">
                        <a href="#" data-toggle="modal" data-target="#addNewCategoryModal"  class="btn btn-primary btn-sm">New
                            Category</a>
                    </span>
                </h4>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                <thead>
                    <th>Sn</th>
                    <th>Cover</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <td>
                            <img src="{{ $category->imageUrl() }}" class="img-fluid" width="100">
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{optional( $category->parent)->name ?? "N/A" }}</td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>


                            <a href="#"  data-toggle="modal" data-target="#editCategoryModal_{{$category->id}}"   class="mb-2">
                                <i data-feather="edit-2" class="text-info"></i></a>
                            </a>

                            <form action="{{ route("admin.product-categories.destroy", $category->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-feather="trash-2" class="text-danger mt-3" onClick="$(this).parent().trigger('submit')"></button>
                            </form>

                        </td>
                    </tr>
                    @include("dashboards.admin.product_categories.modals.category.edit" , ["category" => $category])
                    @endforeach
                </tbody>
            </table>
            {!! $categories->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>

@include("dashboards.admin.product_categories.modals.category.add")

@endsection
