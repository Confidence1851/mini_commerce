<div class="modal fade" id="cancelRequest_{{ $withdrawal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route("admin.withdrawal_decline" , $withdrawal->id) }}" method="POST"> @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Decline Request #{{ $withdrawal->reference }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Please be as descriptive and polite as possible.</p>
                <textarea class="form-control" required name="comment" placeholder="Tell the user why you want to decline the withdrawal request..." id=""rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
