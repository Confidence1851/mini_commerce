<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Helpers\MediaHandler;
use App\Helpers\Wallet;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\QueryBuilder\UserQueryBuilder;
use App\Services\Auth\AuthorizationService;
use App\Services\Finance\WalletService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $mediaHandler;
    public function __construct(MediaHandler $mediaHandler)
    {
        $this->mediaHandler = $mediaHandler;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        AuthorizationService::hasPermissionTo("can_read_users");
        $users = UserQueryBuilder::filterIndex($request)
            ->orderby("id", "desc")
            ->paginate(20)->appends($request->query());
        $sn = $users->firstItem();
        $roles = [
            "Admin", "User"
        ];
        return view("dashboards.admin.users.index", [
            "users" => $users,
            "sn" => $sn,
            "roles" => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        AuthorizationService::hasPermissionTo("can_read_users");
        $user = User::whereNotIn("email", [Constants::DEV_EMAIL])
            ->findOrFail($id);
        // $wallet = WalletService::get($user->id);
        // $walletOptions = Constants::WALLET_OPTIONS;
        return view("dashboards.admin.users.show", [
            "user" => $user,
            // "wallet" => $wallet,
            // "walletOptions" => $walletOptions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        AuthorizationService::hasPermissionTo("can_edit_users");
        $role_permissions = collect();
        if (isDev()) {
            $role_permissions = Role::get();
        }
        return view("dashboards.admin.users.edit", ["user" => $user, "role_permissions" => $role_permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        AuthorizationService::hasPermissionTo("can_edit_users");
        $data = $request->validate([
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:users,email,$user->id",
            "phone" => "nullable|string",
            "status" => "nullable|string|in:Active,Inactive",
            "avatar" => "nullable|image",
            "password" => "nullable|string|min:8|confirmed"
        ]);

        if (!empty($avatar = $request->file("avatar"))) {
            $filePath = putFileInPrivateStorage($avatar, "temp");
            $avatarFile = $this->mediaHandler->saveFromFilePath(storage_path("app/$filePath"), "avatars", null, $user->id);
            $data["avatar_id"] = $avatarFile->id;
        }

        if (!empty($password = $data["password"] ?? null)) {
            $data["password"] = Hash::make($password);
        } else {
            unset($data["password"]);
        }


        $user->update($data);
        if (isDev()) {
            if (!empty($role = $request->role_permission)) {
                $user->syncRoles([$role]);
            } else {
                $user->syncRoles([]);
            }
        }
        return back()->with("success_message", "Changes saved successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        AuthorizationService::hasPermissionTo("can_delete_users");
        $user->delete();
        return back()->with("error_message", "Deleted successfully!");
    }

    public function imitate($id)
    {
        if (!isDev()) {
            return back();
        }

        Auth::loginUsingId($id);
        return redirect()->route("home");
    }

    public function modifyAccount(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            AuthorizationService::hasPermissionTo("can_update_wallet_balance");
            $data = $request->validate([
                "wallet" => "required|string|" . Rule::in(Constants::WALLET_TYPES),
                "action" => "required|in:debit,credit",
                "amount" => "required|gt:0",
                "description" => "required|string|max:200"
            ]);

            $user = User::findOrFail($id);
            $amount = $data["amount"];
            $description = $data["description"];
            $fee = 0;

            $wallet = $data["wallet"];

            if ($data["action"] == "debit") {
                Wallet::debit(
                    $wallet,
                    $user,
                    $amount,
                    $fee,
                    $description,
                    Constants::COMPLETED,
                    true,
                    true
                );
            } else {
                Wallet::credit(
                    $wallet,
                    $user,
                    $amount,
                    $description,
                    Constants::COMPLETED,
                    true,
                    true
                );
            }
            DB::commit();
            return back()->with("success_message", "Transaction completed successfully!");
        } catch (Exception $e) {
            logger("Modify account error:" . $e->getMessage(), $e->getTrace());
            DB::rollback();
            throw $e;
        }
    }
}
