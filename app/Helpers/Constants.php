<?php

namespace App\Helpers;

class Constants{

     const ACTIVE = 1;
     const INACTIVE = 0;

     const DEBIT_TRANSACTION = "Debit";
     const CREDIT_TRANSACTION = "Credit";

     const APPROVED = "Approved";
     const SUSPENDED = "Suspended";
     const PENDING = "Pending";
     const COMPLETED = "Completed";
     const PROCESSING = "Processing";
     const CANCELLED = "Cancelled";
     const DECLINED = "Declined";

     const WALLET_PAYMENT = "Wallet";
     const WALLET_DEFAULT = "balance";
     const WALLET_REFERRAL = "referral_earnings";
     const WALLET_NON_REFERRAL = "non_referral_earnings";

     const WALLET_TYPES = [
         self::WALLET_DEFAULT,
         self::WALLET_REFERRAL,
         self::WALLET_NON_REFERRAL,
     ];

     const WALLET_OPTIONS =  [
        self::WALLET_DEFAULT => "Main",
        self::WALLET_REFERRAL => "Referral Earnings",
        self::WALLET_NON_REFERRAL => "Non-referral Earnings",
     ];

     static public function walletName(string $account)
     {
         return self::WALLET_OPTIONS[$account];
     }


     const DEFAULT_USER = "User";
     const ADMIN_USER = "Admin";

     const NGN_USD_RATE = 500;
     const MIN_VENDOR_DEPOSIT_NGN = 5000;

     const PAGINATION_SIZE = 20;

     const PERCENTAGE = "Percent";
     const FIXED = "Fixed";

     const VENDOR_COUPON_PROFIT_TYPE = self::PERCENTAGE;
     const VENDOR_COUPON_PROFIT_FIXED = 100;
     const VENDOR_COUPON_PROFIT_PERCENT = 5;
     const RESUBCRIPTION_BONUS_PERCENT = 5;


     const BLOG = "Blog";
     const VLOG = "Vlog";

     const BOOL_OPTIONS = [
        self::ACTIVE => "Yes",
        self::INACTIVE => "No",
     ];


     const WEB_GUARD = "web";
     const PLAN_GUARD = "plan";

     const PERMISSION_GUARDS = [
        self::WEB_GUARD => "Site Role",
        self::PLAN_GUARD => "Subscription Plan"
     ];


    //  Error Codes
    const ERROR_CODE = 1000101;

    const DEV_EMAIL = "confidence@flairworlds.com";

    const FLUTTERWAVE = "Flutterwave";

}
