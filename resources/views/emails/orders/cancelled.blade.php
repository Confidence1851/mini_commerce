@component('mail::message')
Hello {{$user->first_name}},

Your order with reference <b>#{{$reference}}</b> has been cancelled

<b style="color: red">Reason: </b> {{$message}}

@component('mail::button', ['url' => route("login")])
    Login to account
@endcomponent

Thanks,<br>
Customer Care
@endcomponent
