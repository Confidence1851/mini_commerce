@extends("dashboards.admin.layouts.app")
@section('content')

<div class="row">
    <div class="col-md-7">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Order Details
                            <span class="fr">
                        <a type="button" class="btn btn-sm btn-danger">Cancel Order</a>
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="mb-2">
                    <b>Customer Name</b> : {{$order->user->names()}}
                </div>
                <div class="mb-2">
                    <b>Unique Reference</b> : {{$order->reference }}
                </div>
                <div class="mb-2">
                    <b>Total Amount</b> : {{ format_money($order->amount , 2 , $order->payment->currency)}}
                </div>
                <div class="mb-2">
                    <b>Total Discount</b> : {{ format_money($order->discount , 2 , $order->payment->currency)}}
                </div>
                <div class="mb-2">
                    <b>Order Status</b> : {{$order->status }}
                </div>
                <div class="mb-2">
                    <b>Customer Comment</b> : {{$order->comment ?? "None" }}
                </div>
                <hr>
                <div class="mb-2">
                    <b>Payment Reference</b> : {{$order->payment->reference }}
                </div>
                <div class="mb-2">
                    <b>Payment Status</b> : {{$order->payment->status }}
                </div>
                <div class="mb-2">
                    <b>Payment Payer Email</b> : {{$order->payment->payer_email }}
                </div>
                <div class="mb-2">
                    <b>Payment Method</b> : {{$order->payment->method }}
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-5">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Activities</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route("admin.roles.update_status")}}" method="post" class="form-row">
                    @csrf
                    <input type="hidden" name="order_id" value="{{$order->id}}" required>
                    <div class="form-group col-8">
                        {{-- <label for="">Status</label> --}}
                        <select name="status" id="" class="form-control">
                            <option value="" disabled selected>Select Status</option>
                            @foreach ($statusOptions as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
                <ul class="mt-3">
                    @foreach ($histories as $history)
                        <li>
                            <div class="">
                                <b>Actor: </b> {{$history["actor_name"] ?? "N/A"}}
                            </div>
                            {{-- <div class="">
                                <b>Action: </b> {{$history["action"] ?? "N/A"}}
                            </div> --}}
                            <div class="">
                                <b>Message: </b> {{$history["message"] ?? "N/A"}}
                            </div>
                            <div class="">
                                <b>Date: </b> {{$history["timestamp"] ?? "N/A"}}
                            </div>
                            <hr>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Order Items</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
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
                                <td><img src="{{ optional($order->product)->getDefaultImage() }}" alt="{{$product->name}}" width="100"></td>
                                <td>
                                    <a href="{{ route("admin.products.show" , $order->user_id) }}" class="text-primary">
                                        {{ $item->product_name }}
                                    </a>
                                </td>
                                <td>{{ format_money($item->unit_price , 2 , $order->payment->currency) }}</td>
                                <td>{{ format_money($item->discount , 2 , $order->payment->currency) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ format_money($item->total , 2 , $order->payment->currency) }}</td>
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


</div>
@endsection
