@extends("dashboards.admin.layouts.app")
@section('content')

    <div class="statbox widget box box-shadow mt-5">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Withdrawals</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <th>User</th>
                        <th>Reference</th>
                        <th>Amount</th>
                        <th>Fee</th>
                        <th>Bank Name</th>
                        <th>Account Name</th>
                        <th>Account No.</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Request Date</th>
                        <th>Confirmed At</th>
                        <th>Created At</th>
                        <th colspan="3">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $withdrawal)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.users.show', $withdrawal->user_id) }}" target="_blank" class="text-primary">
                                        {{ optional($withdrawal->user)->names() }}
                                    </a>
                                </td>
                                <td>{{ $withdrawal->reference }}</td>
                                <td>{{ format_money($withdrawal->amount) }}</td>
                                <td>{{ format_money($withdrawal->fee) }}</td>
                                <td>{{ $withdrawal->bank_name }}</td>
                                <td>{{ $withdrawal->account_name }}</td>
                                <td>{{ $withdrawal->account_number }}</td>
                                <td>{{ $withdrawal->status }}</td>
                                <td>{{ $withdrawal->comment ?? 'N/A' }}</td>
                                <td>{{ date('Y-m-d', strtotime($withdrawal->request_date)) }}</td>
                                <td>{{ !empty(($key = $withdrawal->confirmation_date)) ? date('Y-m-d', strtotime($key)) : 'N/A' }}
                                </td>
                                <td>{{ date('Y-m-d', strtotime($withdrawal->created_at)) }}</td>
                                <td colspan="3">

                                    @if (!$withdrawal->isComplete())
                                    <ul class="table-controls">
                                        <li class="mb-3">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Change Status
                                                </button>
                                                <button class="btn btn-success mt-3" type="button"  data-toggle="modal" data-target="#completeRequest_{{ $withdrawal->id }}">
                                                    Complete
                                                </button>
                                                <button class="btn btn-danger mt-3" type="button"  data-toggle="modal" data-target="#cancelRequest_{{ $withdrawal->id }}">
                                                    Reject
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @foreach (['Pending', 'Processing'] as $status)
                                                        <a class="dropdown-item" onclick="return confirm('Are you sure of the action?')"
                                                            href="{{ route('admin.withdrawal_status', ['id' => $withdrawal->id, 'status' => $status]) }}">
                                                            Mark as {{ ucfirst($status) }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    @endif
                                </td>
                            </tr>
                            @if (!$withdrawal->isComplete())
                            @include("dashboards.admin.withdrawals.modals.decline")
                            @include("dashboards.admin.withdrawals.modals.complete")
                            @endif
                        @endforeach

                    </tbody>
                </table>
                {!! $withdrawals->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>

@endsection
