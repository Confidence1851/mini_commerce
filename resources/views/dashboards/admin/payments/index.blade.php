@extends("dashboards.admin.layouts.app")
@section('content')

    <div class="statbox widget box box-shadow mt-5">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Payments</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <th>User</th>
                        <th>Payer Email</th>
                        <th>Payment Method</th>
                        <th>Reference</th>
                        <th>Amount</th>
                        <th>Fees</th>
                        <th>Status</th>
                        <th>Confirmed At</th>
                        <th>Confirmed By</th>
                        <th>Created At</th>
                        {{-- <th>Actions</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>
                                    <a href="{{ route("admin.users.show" , $payment->user_id) }}" class="text-primary">
                                        {{ optional($payment->user)->names() }}
                                    </a>
                                </td>
                                <td>{{ $payment->payer_email }}</td>
                                <td>{{ $payment->method }}</td>
                                <td>{{ $payment->reference }}</td>
                                <td>{{ format_money($payment->amount , 2 , $payment->currency) }}</td>
                                <td>{{ format_money($payment->fees , 2 , $payment->currency) }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ $payment->confirmed_at ?? "N/A" }}</td>
                                <td>{{ optional($payment->admin)->names() ?? "N/A" }}</td>
                                <td>{{ date('Y-m-d', strtotime($payment->created_at)) }}</td>
                                {{-- <td></td> --}}
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $payments->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>

@endsection
