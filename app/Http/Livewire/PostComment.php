<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostComment as ModelsPostComment;
use Livewire\Component;

class PostComment extends Component
{
    public $post;
    public $comments;
    public $name;
    public $email;
    public $comment;

    public function mount()
    {
        $comments = ModelsPostComment::where("post_id" , $this->post->id)->orderby("created_at" , "asc")->get();
        $this->comments = $comments;
    }


    public function store()
    {
        $user = auth()->user();
        if(!empty($user)){
            $this->name = $user->names();
            $this->email = $user->email;
        }

        $data = $this->validate([
            "name" => "string|required",
            "email" => "string|email|required",
            "comment" => "required|string"
        ]);

        $data["user_id"] = $user->id ?? null;
        $data["post_id"] = $this->post->id;

        $newComment = ModelsPostComment::create($data);
        $this->comments->push($newComment);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['name', 'email' , 'comment']);
    }


    public function render()
    {
        return view('livewire.post-comment');
    }
}
