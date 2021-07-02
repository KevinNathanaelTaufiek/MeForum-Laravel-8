<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Comment;
use Auth;

class ForumController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $forums = Forum::where('title','LIKE','%'.$request->cari.'%')->get()->sortByDesc('updated_at');
        return view('Forum.forums', compact('forums'));
    }

    public function getForum($id){
        $forum = Forum::findOrFail($id);
        $comments = Comment::where('forum_id','LIKE',$id)->get();
        return view('Forum.detail', compact('forum','comments'));
    }

    public function create(){
        return view('Forum.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:10|max:255',
            'content' => 'required'
        ]);

        Forum::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect('/forums');
    }

    public function update(Request $request, $id){
        $forum = Forum::findOrFail($id);
        $forum->update([
            'title' => $request->title,
            'content' => $request->content
        ]);
        return redirect('/forum'.'/'.$id);
    }

    public function delete($id){
        Forum::destroy($id);
        return redirect('/forums');
    }
}
