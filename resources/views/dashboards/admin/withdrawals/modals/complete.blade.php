<div class="modal fade" id="completeRequest_{{ $withdrawal->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.withdrawal_complete', $withdrawal->id) }}" method="POST"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Complete Request #{{ $withdrawal->reference }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        You are about to mark this withdrawal request as complete. <br>
                        <b>Please confirm all payment details before proceeding!!!</b>
                    </p>
                    <h4 class="text-warning"><b>Amount</b> > {{ dollarToNaira($withdrawal->amount) }}</h4>
                    <p><b>Bank Name</b> > {{ $withdrawal->bank_name }}</p>
                    <p><b>Account Name</b> > {{ $withdrawal->account_name }}</p>
                    <p><b>Account Number</b> > {{ $withdrawal->account_number }}</p>
                    <p class="text-danger mb-3 mt-2"><b>This action cannot be reversed!</b></p>

                    @if (!empty(($subs = $withdrawal->user->activeSubscriptions)))
                        <p class="text-danger">Select active plans to deactivate.</p>
                        @foreach ($subs as $sub)
                            @php
                                $expiresAt = carbon()
                                    ->parse($sub->expires_at)
                                    ->format('Y-m-d');
                                $hasExpired = carbon()
                                    ->parse($sub->expires_at)
                                    ->isPast();
                            @endphp
                            <div class="form-group d-flex">
                                <input type="checkbox" name="terminated_subscriptions[]" class="mt-1 mr-1" value="{{$sub->id}}">
                                <label for="" class="{{ $hasExpired ? 'text-dangger' : 'text-success' }}">{{ $sub->plan_name }}
                                    plan to expire at {{ $expiresAt }} </label>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                        Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
