<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        Comment::create([
            'forum_id' => $request->forum_id,
            'user_id' => Auth::user()->id,
            'comment'=> $request->content
        ]);
        return redirect('/forum'.'/'.$request->forum_id);
    }

    public function update(Request $request, $id){
        Comment::where('id',$id)->update([
            'comment'=> $request->comment
        ]);
        return back();
    }
}
