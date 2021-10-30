<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Constants;
use App\Helpers\PlanSubscription;
use App\Helpers\ReferralService;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\RegisterTrait;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $referralService;
    public function __construct()
    {
        $this->middleware('guest');
        $this->referralService = new ReferralService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {
            $names = explode(" " , $data["name"]);
            $first_name = $names[0];
            $last_name = $names[1] ?? null;
            $newUser = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $data['email'],
                'status' => "Active",
                "role" => "User",
                "ref_code" => User::newRefCode(),
                "email_verified_at" => now(),
                'password' => Hash::make($data['password']),
            ]);


            DB::commit();
            return $newUser;
        } catch (\Throwable $th) {
            DB::rollBack();
            if($th->getCode() == Constants::ERROR_CODE){
                throw $th;
            }
            throw new Exception("An error occured while processing your request!");
        }
    }




    public function register(Request $request)
    {
        try {

            $validator = $this->validator($request->all());

            if($validator->fails()){
                return back()->withErrors($validator)
                        ->withInput();
            }


            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                return $response;
            }

            return redirect($this->redirectPath());
        } catch (\Throwable $th) {
            return back()
            ->withErrors($validator)
            ->withInput()
            ->with("error_message", $th->getMessage());
        }
    }

    public function ref_invite($ref_code)
    {
        $referrerUser = User::where("ref_code", $ref_code)->first();
        if (!empty($referrerUser)) {
            $this->referralService->initiateInvite($referrerUser);
        }
        return redirect()->route("register");
    }


    public function showRegistrationForm()
    {
        $referrer = $this->referralService->getSessionReferrer();
        return view('auth.register', ["referrer" => $referrer]);
    }
}
