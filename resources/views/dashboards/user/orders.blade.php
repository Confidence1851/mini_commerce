@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Orders"])
@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Orders"])
@section("content_")

<div class="tab-pane fade show active" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <h3>Orders</h3>
        @if ($orders->isNotEmpty())
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>SN</th>
                        <th>Reference</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sn = $orders->firstItem();
                    @endphp
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{ $order->reference}}</td>
                        <td>{{ $order->items()->count()}}</td>
                        <td>{{ format_money($order->amount) }}</td>
                        <td>{{ $order->status}}</td>
                        <td>{{ $order->created_at}}</td>
                        <td><a href="{{ route('user.order-details', [$order->id]) }}" class="check-btn sqr-btn ">View</a></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {!! $orders->links("pagination::bootstrap-4") !!}
        @else
        <div class="text-center">No data found at the moment</div>
        @endif
    </div>
</div>

@endsection
