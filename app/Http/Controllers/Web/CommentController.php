<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request , $uuid)
    {
        $user = auth()->user();
        if(!empty($user)){
            $request->name = $user->names();
            $request->email = $user->email;
        }

        $data = $request->validate([
            "name" => "string|required",
            "email" => "string|email|required",
            "comment" => "required|string"
        ]);

        $post = Post::active()->findByUuid($uuid)->firstOrFail();
        $data["user_id"] = $user->id ?? null;
        $data["post_id"] = $post->id;
        PostComment::create($data);
        return back();

    }


    public function destroy($id)
    {
        //
    }
}
