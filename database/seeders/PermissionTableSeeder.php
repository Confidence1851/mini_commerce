<?php

namespace Database\Seeders;

use App\Services\Auth\AuthorizationService;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "can_read_posts",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_posts",
                "guard_name" => "web",
            ],
            [
                "name" => "can_edit_posts",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_posts",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_post_categories",
                "guard_name" => "web",
            ],
            [
                "name" => "can_edit_post_categories",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_post_categories",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_post_categories",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_users",
                "guard_name" => "web",
            ],
            [
                "name" => "can_edit_users",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_users",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_users",
                "guard_name" => "web",
            ],
            [
                "name" => "can_update_wallet_balance",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_subscriptions",
                "guard_name" => "web",
            ],
            [
                "name" => "can_edit_subscriptions",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_subscriptions",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_plans",
                "guard_name" => "web",
            ],

            [
                "name" => "can_edit_plans",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_plans",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_plans",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_transactions",
                "guard_name" => "web",
            ],

            [
                "name" => "can_edit_transactions",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_transactions",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_transactions",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_withdrawal_requests",
                "guard_name" => "web",
            ],
            [
                "name" => "can_edit_withdrawal_requests",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_withdrawal_requests",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_withdrawal_requests",
                "guard_name" => "web",
            ],
            [
                "name" => "can_complete_withdrawal_requests",
                "guard_name" => "web",
            ],
            [
                "name" => "can_decline_withdrawal_requests",
                "guard_name" => "web",
            ],
            [
                "name" => "can_terminate_withdrawal_requests",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_coupons",
                "guard_name" => "web",
            ],
            [
                "name" => "can_edit_coupons",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_coupons",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_coupons",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_referrals",
                "guard_name" => "web",
            ],
            [
                "name" => "can_create_vendors",
                "guard_name" => "web",
            ],
            [
                "name" => "can_edit_vendors",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_vendors",
                "guard_name" => "web",
            ],
            [
                "name" => "can_delete_vendors",
                "guard_name" => "web",
            ],
            [
                "name" => "can_read_user_activities",
                "guard_name" => "web",
            ],

        ];

        // foreach ($data as $perm) {
        //     Permission::firstOrCreate($perm);
        // }

        AuthorizationService::syncAdminRoles();

    }
}
