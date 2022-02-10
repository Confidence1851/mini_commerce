<?php

namespace App\Constants;

class CurrencyConstants
{


    const FLUTTERWAVE = "Flutterwave";
    const FUND_WITH_CARD = "Card";
    const FUND_WITH_BANK = "Bank";
    const WITHDRAW_WITH_BANK = "Bank";


    const FLUTTERWAVE_SUPPORTED_CURRENCIES = ["USD", "NGN"];

    public static function toDollar($rate)
    {
        return 1 / $rate;
    }
}
