<div class="modal fade" id="newTransactionModal" tabindex="-1" role="dialog" aria-labelledby="newTransactionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route("admin.users.modify.account" , $user->id) }}" method="POST" onsubmit="return confirm('Are you sure of this action? This action is irreversible!!!')"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">New Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Wallet Type</label>
                        <select class="form-control" required name="wallet">
                            <option value="" disabled selected>Select Option</option>
                            @foreach ($walletOptions as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Action Type</label>
                        <select class="form-control" required name="action">
                            <option value="" disabled selected>Select Option</option>
                            <option value="debit">Debit</option>
                            <option value="credit">Credit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input class="form-control" required name="description" placeholder="Enter description" />
                    </div>
                    <div class="form-group">
                        <label for="">Amount ($)</label>
                        <input class="form-control" required name="amount" step="any" type="number" placeholder="Enter amount in dollars" />
                    </div>

                    <p class="text-danger">This action may add or subtract funds from this users account.
                        Also note that the user would see this on their dashboard.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>
