@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Orders details"])
@section("content_")

<div class="tab-pane fade show active" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <h3>Order Details</h3>
        <div class="">
            <div class="mb-2">
                <b>Name</b> : {{$order->user->names()}}
            </div>
            <div class="mb-2">
                <b>Unique Reference</b> : {{$order->reference }}
            </div>
            <div class="mb-2">
                <b>Total Amount</b> : {{ format_money($order->amount , 2 , optional($order->payment)->currency)}}
            </div>
            <div class="mb-2">
                <b>Total Discount</b> : {{ format_money($order->discount , 2 , optional($order->payment)->currency)}}
            </div>
            <div class="mb-2">
                <b>Order Status</b> : {{$order->status }}
            </div>
            <div class="mb-2">
                <b>Comment</b> : {{$order->comment ?? "None" }}
            </div>
            <hr>
            <div class="mb-2">
                <b>Payment Reference</b> : {{optional($order->payment)->reference }}
            </div>
            <div class="mb-2">
                <b>Payment Status</b> : {{optional($order->payment)->status }}
            </div>
            <div class="mb-2">
                <b>Payment Payer Email</b> : {{optional($order->payment)->payer_email }}
            </div>
            <div class="mb-2">
                <b>Payment Method</b> : {{optional($order->payment)->method }}
            </div>
        </div>
    </div>

    <div class="myaccount-content mt-3">
        <h3>Order Items</h3>
        <div class="myaccount-table table-responsive text-center">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <th>SN</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        {{-- <th>Status</th> --}}
                        <th>Extra</th>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $key => $item)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td><img src="{{ optional($item->product)->getDefaultImage() }}" alt="{{$item->product->name}}" width="100"></td>
                            <td>
                                <a href="{{ route("admin.products.show" , $order->user_id) }}" class="text-primary">
                                    {{ $item->product_name }}
                                </a>
                            </td>
                            <td>{{ format_money($item->unit_price , 2 , optional($order->payment)->currency) }}</td>
                            <td>{{ format_money($item->discount , 2 , optional($order->payment)->currency) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ format_money($item->total , 2 , optional($order->payment)->currency) }}</td>
                            {{-- <td>{{ $item->status }}</td> --}}
                            <td>{{ $item->extra }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
