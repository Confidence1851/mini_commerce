<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\BankAccessCodeMail;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    public function bankDetails()
    {
        $user = auth()->user();
        $account = BankAccount::where("user_id", $user->id)->first();
        return view("dashboards.user.account.bank_details", ["account" => $account]);
    }

    public function bankDetailsUpdate(Request $request)
    {
        $id = $request->account_id;
        $data = $request->validate([
            "bank_name" => "required|string",
            "account_name" => "required|string",
            "account_number" => "required|string|unique:bank_accounts,account_number,$id",
            "access_code" => "nullable|string",
        ]);

        $user = auth()->user();
        $account = BankAccount::where("user_id", $user->id)->first();
        if (!empty($account)) {
            $access_code = $request->access_code;
            if ($account->access_code != $access_code) {
                return redirect()->back()->with("error_message", "Access code is invalid!");
            }
        }

        $data["access_code"] =  BankAccount::getNewCode();
        BankAccount::updateOrCreate(
            ["user_id" => $user->id],
            $data
        );
        return redirect()->back()->with("success_message", "Bank account updated successfully");
    }

    public function requestBankChange()
    {

        $user = auth()->user();
        $account = BankAccount::where("user_id", $user->id)->first();

        if (empty($account)) {
            return redirect()->back()->with("error_message", "You dont have a bank account yet!");
        }

        $access_code = BankAccount::getNewCode();
        $account->update([
            "access_code" => $access_code
        ]);

        $mailData = [
            "user" => $user,
            "access_code" => $access_code
        ];

        // Mail::to($user->email)->send(new BankAccessCodeMail($mailData));
        sendMailHelper([
            "data" => $mailData,
            "to" => $user->email,
            "template" => "emails.user.account.bank_access_code",
            "subject" => "Bank Account Access Code",
        ]);
        return redirect()->back()->with("success_message", "An access code has been sent to your email!");
    }
}
