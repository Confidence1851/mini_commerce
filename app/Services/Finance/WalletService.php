<?php

namespace App\Services\Finance;

use App\Constants\StatusConstants;
use App\Constants\TransactionActivityConstants;
use App\Constants\TransactionConstants;
use App\Exceptions\Finance\Wallet\WalletException;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransfer;
use Exception;
use Illuminate\Support\Facades\DB;

class WalletService
{

    const WALLET_CURRENT = "current_balance";
    const WALLET_LOCKED = "locked_balance";
    const WALLET_TOTAL = "total_earnings";
    const WALLET_ELITE_POINTS = "elite_points";

    const WALLET_TYPES = [
        self::WALLET_CURRENT,
        self::WALLET_LOCKED,
        self::WALLET_ELITE_POINTS
    ];

    static public function walletName(string $account)
    {
        return [
            self::WALLET_CURRENT => "Main",
            self::WALLET_LOCKED => "Locked",
            self::WALLET_TOTAL => "Total",
            self::WALLET_ELITE_POINTS => "Elite Points"
        ][$account];
    }


    public static function create($user_id): Wallet
    {
        return Wallet::where("user_id", $user_id)->firstOrCreate([
            "user_id" => $user_id,
            "current_balance" => 0,
            "locked_balance" => 0,
            "pin" => null,
            // "payment_ref" => self::newRefCode()
        ]);
    }


    public static function get($user_id): Wallet
    {
        $wallet = Wallet::where("user_id", $user_id)->first();

        if (empty($wallet)) {
            return self::create($user_id);
        }

        return $wallet;
    }


    public static function credit(string $walletType,  $user_id, float $amount, bool $add_to_total = false)
    {
        if (!in_array($walletType, self::WALLET_TYPES)) {
            throw new WalletException("Invalid wallet type provided.");
        }

        $wallet = self::get($user_id);
        $balance = $wallet->$walletType;
        $data[$walletType] = $balance + $amount;

        if ($add_to_total) {
            $data["total_earnings"] = $wallet->total_earnings + $amount;
        }
        $wallet->update($data);
    }

    public static function debit(string $walletType,  $user_id, float $amount)
    {
        if (!in_array($walletType, self::WALLET_TYPES)) {
            throw new WalletException("Invalid wallet type provided.");
        }

        $wallet = self::get($user_id);
        $balance = $wallet->$walletType;

        if ($balance < $amount) {
            throw new WalletException("Insuffient fund");
        }

        $wallet->update([
            $walletType => $balance - $amount,
        ]);
    }




    public static function newRefCode()
    {
        // Generate a random code
        $code = strtoupper(getRandomToken(6));
        // Check if the code exists in the user table
        if (Wallet::where("payment_ref", $code)->count() > 0) {
            // If it is in the database , call the function again
            return self::newRefCode();
        }
        // Else return the generated code
        return $code;
    }
}
