@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Order Details"])
@section("content_")

<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class=" col-md-8 ">
                    <h4>Order Details
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <b>Name</b> : {{$orderDetails->user->names()}}
            </div>
            <div class="mb-2">
                <b>Unique Reference</b> : {{$orderDetails->reference }}
            </div>
            <div class="mb-2">
                <b>Total Amount</b> : {{ format_money($orderDetails->amount , 2 , optional($orderDetails->payment)->currency)}}
            </div>
            <div class="mb-2">
                <b>Total Discount</b> : {{ format_money($orderDetails->discount , 2 , optional($orderDetails->payment)->currency)}}
            </div>
            <div class="mb-2">
                <b>Status</b> : {{$orderDetails->status }}
            </div>
            <!-- <div class="mb-2">
                <b>Customer Comment</b> : {{$orderDetails->comment ?? "None" }}
            </div>
            <hr>
            <div class="mb-2">
                <b>Payment Reference</b> : {{ $orderDetails->reference }}
            </div> -->
            <div class="mb-2">
                <b>Payment Status</b> : {{$orderDetails->status }}
            </div>
            <!-- <div class="mb-2">
                <b>Payment Payer Email</b> : {{ $orderDetails->payer_email }}
            </div> -->
            <div class="mb-2">
                <b>Payment Method</b> : {{$orderDetails->payment_method }}
            </div>
        </div>
    </div>
</div>
@endsection
