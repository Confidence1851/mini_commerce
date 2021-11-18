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
                            <a href="{{ route("admin.orders.show" , $order->id)}}" >
                                <i data-feather="eye" class="text-warning mr-2"></i></a>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {!! $orders->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>

@endsection
