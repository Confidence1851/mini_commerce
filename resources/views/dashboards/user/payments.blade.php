@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Payments"])
@section("content_")

<div class="tab-pane fade show active" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <h3>Payments</h3>
        @if ($payments->isNotEmpty())
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>SN</th>
                        <th>Reference</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sn = $payments->firstItem();
                    @endphp
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{ $payment->reference}}</td>
                        <td>{{ format_money($payment->amount) }}</td>
                        <td>{{ $payment->method}}</td>
                        <td>{{ $payment->status}}</td>
                        <td>{{ $payment->created_at}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {!! $payments->links("pagination::bootstrap-4") !!}
        @else
        <div class="text-center">No data found at the moment</div>
        @endif
    </div>
</div>

@endsection
