@extends("dashboards.admin.layouts.app")
@section('content')

<div class="row ">

    <div class=" col-md-12 col-sm-12 col-12">
        <div class="row widget-statistic">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                <div class="widget widget-one_hybrid widget-followers">
                    <div class="widget-heading">
                        <div class="w-title">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <a class="" href="{{ route('admin.users.index') }} ">
                                <p class="w-value">{{ $analytics['users']['count'] ?? 'N/A' }}</p>
                                <h5 class="">Users</h5>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                <div class="widget widget-one_hybrid widget-referral">
                    <div class="widget-heading">
                        <div class="w-title">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71">
                                    </path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71">
                                    </path>
                                </svg>
                            </div>
                            <a class="" href="{{ route('admin.products.index') }} ">
                                <p class="w-value">{{ $analytics['products']['count'] ?? 'N/A' }}</p>
                                <h5 class="">Products</h5>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                <div class="widget widget-one_hybrid widget-engagement">
                    <div class="widget-heading">
                        <div class="w-title">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg>
                            </div>
                            <a class="" href="{{ route('admin.orders.index') }} ">
                                <p class="w-value">{{ $analytics['orders']['count'] ?? 'N/A' }}</p>
                                <h5 class="">Orders</h5>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="col-md-6">
        <div class="widget-four">
            <div class="widget-heading">
                <h5 class="">Lastest Users
                    <a href="{{ route("admin.users.index") }}" class="text-danger">
                        <small style="float: right">See all</small>
                    </a>
                </h5>
            </div>
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th class="">S/N</th>
                                <th class="">Name</th>
                                <th class="">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sn = 1;
                            @endphp
                            @foreach ($latest_users as $user)
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="text-primary">
                                        {{ $user->names() }}
                                    </a>
                                </td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="widget-four">
            <div class="widget-heading">
                <h5 class="">Latest Orders
                    <a href="{{ route("admin.orders.index") }}" class="text-danger">
                        <small style="float: right">See all</small>
                    </a>
                </h5>
            </div>
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th class="">S/N</th>
                                <th class="">Reference</th>
                                <th class="">Total</th>
                                <th class="">Status</th>
                                <th class="">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sn = 1;
                            @endphp
                            @foreach ($latest_orders as $order)
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td><a href="{{ route("admin.orders.show" , $order->id)}}">
                                        {{ $order->reference }}
                                    </a></td>
                                <td>{{ format_money($order->amount) }}</td>
                                <td>
                                    <span class="badge badge-pill badge-{{pillClasses($order->status)}} mb-1">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
