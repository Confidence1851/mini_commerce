<?php

namespace App\Constants;

class PaymentConstants
{


    const PAY_WITH_CARD = "Card";
    const PAY_WITH_BANK = "Bank";

    const PAYMENT_OPTIONS = [
        self::PAY_WITH_BANK,
        self::PAY_WITH_CARD
    ];

    const SUBSCRIBE_TO_MEMBERSHIP_PLAN = "SUBSCRIBE_TO_MEMBERSHIP_PLAN";
    const CART_CHECKOUT = "CART_CHECKOUT";
    const FUND_WALLET_WITH_CARD = "FUND_WALLET_WITH_CARD";
}
