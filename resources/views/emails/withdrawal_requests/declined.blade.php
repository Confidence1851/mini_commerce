@component('mail::message')
Hey {{ $user->first_name }},

Your withdrawal request has been <b>declined</b>.

<p>
    <b style="color: red;">Reason: </b> <span class="text-danger">{!! $comment !!}</span>
</p>



Kindly find the withdrawal details below:

<p>
    <b>Amount: </b> <span class="text-danger">{{ format_money($withdrawal->amount) }}</span>
</p>
<p>
    <b>Account Name: </b> <span class="text-success">{{ $withdrawal->account_name }}</span>
</p>
<p>
    <b>Account Number: </b> <span class="text-success">{{ $withdrawal->account_number }}</span>
</p>
<p>
    <b>Bank Name: </b> <span class="text-success">{{ $withdrawal->bank_name }}</span>
</p>

If you are unaware of this request , please contact support or change your login credentials to ensure account security!

@component('mail::button', ['url' => route("login")])
    Login to account
@endcomponent

Thanks,<br>
Customer Care
@endcomponent
