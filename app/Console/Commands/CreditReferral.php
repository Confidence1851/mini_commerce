<?php

namespace App\Console\Commands;

use App\Helpers\ReferralService;
use App\Models\Referral;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreditReferral extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credit:referral';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Credit referrals';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // DB::beginTransaction();
        // try {
        //     $ids = [17, 19, 20, 21];
        //     $referrals = Referral::with("referrer")
        //         ->with("referrer")
        //         ->with("user")
        //         ->whereIn("id", $ids)
        //         ->get();

        //     $referralService = new ReferralService();
        //     foreach ($referrals as $referral) {
        //         $bonus = $referralService->calculateBonus($referral->user, $referral->referrer);
        //         $referral->bonus = $bonus;
        //         $referral->save();
        //         $referralService->rewardReferrer($referral);
        //     }
        //     DB::commit();
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     throw $e;
        // }
        return 0;
    }
}
