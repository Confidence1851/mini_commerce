<?php

namespace App\Helpers;

use App\Models\Referral;
use App\Models\User;

class ReferralService
{
    const REFERRAL_SESSION_KEY = "ref_invite_code";
    public function initiateInvite($user)
    {
        session()->put(
            self::REFERRAL_SESSION_KEY,
            [
                "name" => $user->first_name,
                "ref_code" => $user->ref_code
            ]
        );
    }

    public function getSessionReferrer()
    {
        $ref_session_key = self::REFERRAL_SESSION_KEY;
        $referrer = null;
        if (session()->has($ref_session_key)) {
            $referrer = session()->get($ref_session_key);
        }
        return $referrer;
    }

    public function newReferral(User $newUser, $ref_code)
    {
        $newUser->refresh();
        if (!empty($ref_code)) {
            $referrerUser = User::where("ref_code", $ref_code)->first();
        }
        
        $isAuto = 0;
        if (empty($referrerUser)) {
            $referrerUser = User::first();
            $isAuto = 1;
        }
        $referral_bonus = $this->calculateBonus($newUser, $referrerUser);

        $referral = Referral::create([
            "user_id" => $newUser->id,
            "referrer_id" => $referrerUser->id,
            "bonus" => $referral_bonus,
            "is_auto" => $isAuto,
        ]);


        if ($referral && !empty($ref = $referral->referrer)) {
            $this->rewardReferrer($referral);
        }
    }

    public function rewardReferrer(Referral $referral)
    {
        Wallet::credit(
            Constants::WALLET_REFERRAL,
            $referral->referrer,
            $referral->bonus,
            "Referral earnings for inviting " . $referral->user->names(),
            Constants::COMPLETED
        );
    }

    public function calculateBonus(User $user, User $referrer)
    {
        $max_bonus = 0;
        $referral_bonus = 0;

        if (!empty($plan = $referrer->plan)) {
            $max_bonus = $plan->referral_bonus ?? 0;
        }

        if (!empty($plan = $user->plan)) {
            $referral_bonus = $plan->referral_bonus ?? 0;
        }

        if ($referral_bonus > $max_bonus) {
            $referral_bonus = $max_bonus;
        }

        return $referral_bonus;
    }
}
