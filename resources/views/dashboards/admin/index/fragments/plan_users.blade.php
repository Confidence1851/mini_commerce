<div class="widget-four">
    <div class="widget-heading">
        <h5 class="">Plans</h5>
    </div>
    <div class="widget-content">
        <div class="vistorsBrowser">

            @foreach ($subscribedPlans as $subscribedPlan)
                <div class="browser-list">

                    <div class="w-browser-details">
                        <div class="w-browser-info">
                            <h6>{{ $subscribedPlan->plan_name }}</h6>
                            <p class="browser-count">{{ $subscribedPlan->plan_counts }} ({{ number_format($subscribedPlan->percentage , 1) }}%)</p>
                        </div>
                        <div class="w-browser-stats">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-{{ ["primary" , "danger" , "warning" , "success" ][rand(0 , 3)] }}"
                                role="progressbar" style="width: {{ $subscribedPlan->percentage }}%"
                                    aria-valuenow="{{ $subscribedPlan->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</div>
