<?php

namespace App\Helpers;

use App\Models\CouponCode;
use App\Models\Plan;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\User;
use Exception;
use Spatie\Permission\Models\Permission;

class PlanSubscription
{

    public $couponService;
    public function __construct()
    {
        $this->couponService = new CouponService;
    }

    public function syncPermissions(User $user, Plan $plan)
    {
        $permissions = Permission::whereIn("name", $plan->getFeatures())->get();
        return $user->syncPermissions($permissions);
    }

    public function removePermissions(User $user)
    {
        return $user->removePermissions();
    }

    public function subscribeToPlan(
        User $user,
        Plan $plan,
        $payment_method,
        $payment_id = null
    ) {
        return Subscription::create([
            "user_id" => $user->id,
            "plan_name" => $plan->name,
            "sponsored_post_bonus" => $plan->sponsored_post_bonus,
            "sponsored_post_bonus_limit" => $plan->sponsored_post_bonus_limit,
            "non_ref_withdrawal_limit" => $plan->non_ref_withdrawal_limit,
            "ref_withdrawal_limit" => $plan->ref_withdrawal_limit,
            "sponsored_posts_per_day" => $plan->sponsored_posts_per_day,
            "referral_bonus" => $plan->referral_bonus,
            "min_refs" => $plan->min_refs,
            "payment_id" => $payment_id,
            "price" => $plan->price,
            "payment_method" => $payment_method,
            "paid_on" => now(),
            "expires_at" => now()->addDays($plan->duration),
            "is_active" => Constants::ACTIVE
        ]);
    }

    public function subscribeFromWallet(User $user, Plan $plan)
    {
        $subscription = $this->subscribeToPlan($user, $plan, "Wallet", null);
        Wallet::debit(
            Constants::WALLET_DEFAULT,
            $user,
            $subscription->price,
            0,
            "Subscribed for $subscription->plan_name plan.",
            Constants::COMPLETED,
            true,
            true
        );
        $this->syncPermissions($user, $plan);
    }


    public function subscribeWithCoupon(User $user, $plan_name, $coupon_code)
    {
        $plan = Plan::where("name", $plan_name)->first();
        $coupon = CouponCode::where("code", $coupon_code)->first();
        if ($plan->price > $coupon->price) {
            throw new Exception("Coupon price is lower than plan price", Constants::ERROR_CODE);
        }

        $process = $this->couponService->deposit($user, $coupon);

        if (!$process["success"]) {
            throw new Exception($process["message"], Constants::ERROR_CODE);
        }

        $this->subscribeFromWallet($user, $plan);
    }


    public function lastSubscription(User $user)
    {
        return Subscription::where("user_id", $user->id)
            ->where("expires_at", "<", now())
            ->orWhere("is_active", Constants::INACTIVE)
            ->orderby("expires_at", "desc")
            ->first();
    }

    public function currentSubscription(User $user)
    {
        return Subscription::where("user_id", $user->id)
            ->where("expires_at", ">", now())
            ->where("is_active", Constants::ACTIVE)
            ->orderby("expires_at", "desc")
            ->first();
    }

    public function resubscriptionBonus(User $user)
    {
        if (!empty($this->lastSubscription($user))) {
            $current = $this->currentSubscription($user);
            $referral = Referral::where("user_id", $user->id)->whereHas("referrer")->with("referrer")->first();

            if (!empty($referral)) {
                $referrer = $referral->referrer;
                $bonus = $current->price * (Constants::RESUBCRIPTION_BONUS_PERCENT / 100);
                Wallet::credit(
                    Constants::WALLET_DEFAULT,
                    $referrer,
                    $bonus,
                    $user->names()."  re-subscription bonus",
                    Constants::COMPLETED
                );

                sendMailHelper([
                    "data" => [
                        "referrer" =>  $referrer,
                        "user" => $user,
                        "bonus" => format_money($bonus)
                    ],
                    "to" => $referrer->email,
                    "template" => "emails.transactions.resubscription_bonus",
                    "subject" => "Resubscription Bonus",
                ]);
            }
        }
    }
}
