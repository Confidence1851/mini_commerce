@extends("dashboards.admin.layouts.app")

@section('content')
    <div class="row">

        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Profile</h3>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="mt-2 edit-profile"> <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-edit-3">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg></a>
                    </div>
                    <div class="text-center user-info">
                        <a href="{{ $user->avatarUrl() }}" target="_blank">
                            <img src="{{ $user->avatarUrl() }}" alt="avatar"  class="img-fluid" width="150">
                        </a>
                        <p class="">
                            <b>
                                {{ $user->names() }}
                            </b>
                        </p>
                    </div>
                    <div class="user-info-list">
                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item mb-2 mr-2">
                                    <b>Email:</b> {{ $user->email }}
                                </li>
                                <li class="contacts-block__item mb-2 mr-2">
                                    <b>Phone:</b> {{ $user->phone ?? 'N/A' }}
                                </li>
                                <li class="contacts-block__item mb-2 mr-2">
                                    <b>Role:</b> {{ $user->role }}
                                </li>
                                <li class="contacts-block__item mb-2 mr-2">
                                    <b>Email Verified At:</b> {{ $user->email_verified_at }}
                                </li>
                                <li class="contacts-block__item mb-2 mr-2">
                                    <b>Joined On:</b> {{ $user->created_at }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-md-8 layout-spacing mt-4">

            <div class="widget widget-account-invoice-three">

                <div class="widget-heading d-none">
                    <div class="wallet-usr-info">
                        <div class="add" data-toggle="modal" data-target="#newTransactionModal">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg></span>
                        </div>
                        @include("dashboards.admin.users.modals.new_transaction" , ["user" => $user])
                    </div>
                    <div class="wallet-balance">
                        <p>Wallet Balance</p>
                        <h5 class=""><span class="w-currency">
                            {{ format_money($wallet->balance) }}
                        </h5>
                    </div>
                </div>



                <div class="widget-content">

                    <div class="invoice-list">


                        <div class="inv-action form-row">
                            <a href="{{ route("admin.orders.index" , ["user_id" => $user->id])}}" class="btn btn-outline-primary pay-now col-auto mb-2">
                               View Orders
                            </a>
                            <a href="{{ route("admin.payments.index", ["user_id" => $user->id])}}" class="btn btn-outline-primary pay-now col-auto mb-2">
                               View Payments
                            </a>
                            {{-- <a href="{{route("admin.transactions.index", [ "user_id" => $user->id ])}}" class="btn btn-outline-primary view-details col-auto mb-2">
                                Transactions
                            </a> --}}
                        </div>

                         <!-- <div class="rol">
                          <div class="col">
                           {{-- {{optional($user->referralRecord())->id}} --}}
                          </div>
                         </div>  -->
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
