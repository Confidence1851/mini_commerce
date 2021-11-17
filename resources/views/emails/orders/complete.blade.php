@component('mail::message')
Hello {{$user->first_name}},

Your order with reference <b>#{{$reference}}</b> has been completed

@component('mail::button', ['url' => route("login")])
    Login to account
@endcomponent

Thanks,<br>
Customer Care
@endcomponent
