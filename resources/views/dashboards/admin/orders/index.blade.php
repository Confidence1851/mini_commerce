@extends("dashboards.admin.layouts.app")
@section('content')

<div class="statbox widget box box-shadow mt-5">
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Orders</h4>
            </div>
        </div>
    </div>
    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">Display Options <i class="simple-icon-arrow-down align-middle"></i></a>
    <div class="collapse d-md-block ml-4" id="displayOptions">
        <div class="d-block d-md-inline-block">
            <div class="btn-group float-md-left mr-1 mb-1">
                <div class=" d-inline-block float-md-left mr-1 mb-1 align-top">
                    <form class="input-group" action="{{ url()->current() }}" method="GET">
                        <input class="form-control" type="text" name="search" value="{{ request()->query('search')}}" placeholder="Search...">
                        <button class="btn btn-outline-primary btn-sm ml-3">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                <thead>
                    <th>User</th>
                    <th>Reference</th>
                    <th>order Method</th>
                    <th>Items</th>
                    <th>Amount</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @if($orders->isNotEmpty())
                    @foreach ($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route("admin.users.show" , $order->user_id) }}" class="text-primary">
                                {{ optional($order->user)->names() }}
                            </a>
                        </td>
                        <td>{{ $order->reference }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->items()->count() }}</td>
                        <td>{{ format_money($order->amount , 2 , optional($order->payment)->currency) }}</td>
                        <td>{{ format_money($order->discount , 2 , optional($order->payment)->currency) }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                        <td>
                            <a href="{{ route("admin.orders.show" , $order->id)}}">
                                <i data-feather="eye" class="text-warning mr-2"></i></a>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    @else

                </tbody>
                <div class="col-12 text-center">
                    <div class="alert alert-danger p-4">{{$message}}</div>
                </div>
                @endif
            </table>
            {!! $orders->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>

@endsection
