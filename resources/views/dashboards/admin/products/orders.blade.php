@extends("dashboards.admin.layouts.app")
@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Orders for {{$product->name}} ({{$orderItems->total()}})</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <th>SN</th>
                            <th>Order</th>
                            <th>Unit Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Extra</th>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                            <tr>
                                <td>{{ $sn++}}</td>
                                <td>
                                    <a href="{{ route("admin.orders.show" , $item->order_id) }}" class="text-primary">
                                        {{ $item->product_name }}
                                    </a>
                                </td>
                                <td>{{ format_money($item->unit_price , 2 , $item->order->payment->currency) }}</td>
                                <td>{{ format_money($item->discount , 2 , $item->order->payment->currency) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ format_money($item->total , 2 , $item->order->payment->currency) }}</td>
                                <td>{{ $item->extra }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection
