@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Orders details"])
@section("content_")

<div class="tab-pane fade show active" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <h3>Order Details</h3>
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Unique Reference</th>
                        <th>Total Amount</th>
                        <th>Total Discount</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Time/Date</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{$orderDetails->user->names()}}</td>
                        <td>{{$orderDetails->reference }}</td>
                        <td>{{ format_money($orderDetails->amount , 2 , optional($orderDetails->payment)->currency)}}</td>
                        <td>{{ format_money($orderDetails->discount , 2 , optional($orderDetails->payment)->currency)}}</td>
                        <td>{{ $orderDetails->status}}</td>
                        <td>{{ $orderDetails->payment_method}}</td>
                        <td>{{ $orderDetails->created_at}}</td>
                    </tr>


                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
