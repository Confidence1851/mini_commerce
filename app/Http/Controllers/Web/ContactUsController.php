<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\NewContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function send(Request $request)
    {
        try {
            $data = $request->validate([
                "name" => "required|string",
                "email" => "required|email",
                "subject" => "required|string",
                "message" => "required|string",
            ]);

            Mail::to("admin@mail.com")->send(new NewContactMessageMail($data));

            return response()->json([
                "success" => true,
                "message" => "Message sent successfully"
            ] , 200);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "We couldn`t process your request at this time."
            ] , 500);
        }
    }
}
