@extends("dashboards.admin.layouts.app")
@section('content')
    <div id="tableCheckbox" class="">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Edit {{ $plan->name }} </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <form action="{{ route('admin.plans.update' , $plan->id) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to assign these features/permissions to this plan?')">
                    @csrf
                    @method("put")

                    <div class="form-row mb-3">

                        <div class="form-group col-md-3">
                            <label for="">Name <span class="required">*</span></label>
                            <input class="form-control" type="text" required name="name" placeholder="Pro..."
                                value="{{ $plan->name }}">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="">Price ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="price" placeholder="In dollars"
                                value="{{ $plan->price }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">Duration (days)<span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="duration" placeholder="In days "
                                value="{{ $plan->duration }}">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="">Is Published <span class="required">*</span></label>
                            <select name="is_active" class="form-control" id="" required>
                                <option value="" disabled selected>Select Option</option>
                                @foreach ($boolOptions as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $plan->is_active ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">Referral Bonus ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="referral_bonus" placeholder="In dollars"
                                value="{{ $plan->referral_bonus }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Sponsored Post Bonus ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="sponsored_post_bonus" placeholder="In dollars"
                            value="{{ $plan->sponsored_post_bonus }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">Referral Withdrawal Limit ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="ref_withdrawal_limit" placeholder="In dollars"
                            value="{{ $plan->ref_withdrawal_limit }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Minimum Referrals ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="min_refs" placeholder=""
                            value="{{ $plan->min_refs }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Sponsored Posts Per Day <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="sponsored_posts_per_day" placeholder="Max posts they can earn from"
                            value="{{ $plan->sponsored_posts_per_day }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Sponsored Post Bonus Limit ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="sponsored_post_bonus_limit" placeholder="Bonus per post"
                            value="{{ $plan->sponsored_post_bonus_limit }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Non referral Withdrawal Limit ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" step="any" required name="non_ref_withdrawal_limit" placeholder="In dollars"
                            value="{{ $plan->non_ref_withdrawal_limit }}">
                        </div>

                        <h5 class="text-danger">Selecting <b>YES</b>
                            would update all active subscriptions as well.Please confirm that you want to do this.
                        </h5>
                        <p>The following would be updated:
                            Sponsored Post Bonus ,
                            Referral Withdrawal Limit,
                            Sponsored Post Bonus Limit,
                            Sponsored Posts Per Day,
                            Non referral Withdrawal Limit
                            and
                            Minimum Referrals!

                        </p>
                        <div class="form-group col-md-12">
                            <label for="">Update Active Subscriptions <span class="required">*</span></label>
                            <select name="update_subscriptions" class="form-control" id="" required>
                                <option value="" disabled selected>Select Option</option>
                                @foreach ($boolOptions as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @include("dashboards.admin.plans.fragments.features" , ["planFeatures" => $planFeatures , "permissions" => $permissions])
                    <button class="btn btn-success mt-3" type="submit">
                        Submit
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
