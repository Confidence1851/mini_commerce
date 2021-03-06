<?php

namespace App\Constants;

class TransactionActivityConstants
{


    const FUND_WITH_FLUTTERWAVE = "FUND_WITH_FLUTTERWAVE";
    const FUND_WITH_BANK = "FUND_WITH_BANK";
    const REFERRAL_BONUS = "REFERRAL_BONUS";
    const SIGNUP_BONUS = "SIGNUP_BONUS";
    const WITHDRAW_FROM_WALLET = "WITHDRAW_FROM_WALLET";
    const WALLET_TRANSFER = "WALLET_TRANSFER";
    const SHARE_ACTIVITY_BONUS = "SHARE_ACTIVITY_BONUS";
    const MODIFY_WALLET = "MODIFY_WALLET";
    const ELITE_SHARING_COMMISSION = "ELITE_SHARING_COMMISSION";
    const CART_CHECKOUT = "CART_CHECKOUT";

    const OPTIONS = [
        self::FUND_WITH_FLUTTERWAVE => "Fund with Flutterwave",
        self::FUND_WITH_BANK => "Fund with Bank",
        self::REFERRAL_BONUS => "Referral Bonus",
        self::SIGNUP_BONUS => "Signup Bonus",
        self::WITHDRAW_FROM_WALLET => "Withdraw from wallet",
        self::SHARE_ACTIVITY_BONUS => "Share Activity Bonus",
        self::MODIFY_WALLET => "Modify Wallet",
        self::ELITE_SHARING_COMMISSION => "Elite Sharing Commission"
    ];
}
