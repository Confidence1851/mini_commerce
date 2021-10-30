@extends("dashboards.admin.layouts.app")
@section('content')
    <div id="tableCheckbox" class="">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> Create  </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <form action="{{ route('admin.plans.store') }}" method="post"
                onsubmit="return confirm('Are you sure you want to assign these features/permissions to this plan?')">
                @csrf

                    <div class="form-row mb-3">

                        <div class="form-group col-md-3">
                            <label for="">Name <span class="required">*</span></label>
                            <input class="form-control" type="text" required name="name" placeholder="Pro..."
                                value="">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="">Price ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="price" placeholder="In dollars"
                                value="" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">Duration (days)<span class="required">*</span></label>
                            <input class="form-control" type="number" required name="duration" placeholder="In days "
                                value="">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="">Is Published <span class="required">*</span></label>
                            <select name="is_active" class="form-control" id="" required>
                                <option value="" disabled selected>Select Option</option>
                                @foreach ($boolOptions as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">Referral Bonus ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="referral_bonus" placeholder="In dollars"
                                value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Sponsored Post Bonus ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="sponsored_post_bonus" placeholder="In dollars"
                                value="" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">Referral Withdrawal Limit ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="ref_withdrawal_limit" placeholder="In dollars"
                                value="" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Minimum Referrals ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="min_refs" placeholder=""
                                value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Sponsored Posts Per Day <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="sponsored_posts_per_day" placeholder="Max posts they can earn from"
                                value="" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Sponsored Post Bonus Limit ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="sponsored_post_bonus_limit" placeholder="Bonus per post"
                                value="" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Non referral Withdrawal Limit ($) <span class="required">*</span></label>
                            <input class="form-control" type="number" required name="non_ref_withdrawal_limit" placeholder="In dollars"
                                value="" >
                        </div>
                    </div>

                    @include("dashboards.admin.plans.fragments.features" , ["planFeatures" => $planFeatures , "permissions" => $permissions])

                    <button  type="submit" class="btn btn-success mt-3">
                        Submit
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
