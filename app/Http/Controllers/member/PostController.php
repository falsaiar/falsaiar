<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStatus;
use App\Http\Requests\PostComment;
use App\Http\Requests\PostRequest;
use App\Model\User;
use App\Model\Status;
use App\Model\Comment;
use App\Model\Post;
use App\Model\Club;
use App\Model\ClubMember;
use App\Model\EBook;


class PostController extends Controller
{
    // Save User Status
     public function poststatus(PostStatus $request)
    {

        $user = Auth::user();
        $status = $request['status'];

        $mind = new Status();
        $mind->user_id = $user->id;
        $mind->status = $status;
        $mind->save();

       \Session::flash('flash_messagex','Status Posted');
         return back();
    }

    // Save User Comment
     public function postcomment(PostComment $request, $id)
    {
        $user = Auth::user();
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->status_id = $id;
        $comment->comment = $request['comment'];
        $comment->save();

       \Session::flash('flash_messagex','Comment Posted');
         return back();
    }

    // Save User Comment 2
     public function postclubcomment(PostComment $request, $id)
    {
        $user = Auth::user();
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $id;
        $comment->comment = $request['comment'];
        $comment->save();

       \Session::flash('flash_messagex','Comment Posted');
         return back();
    }

    // Save User Status
     public function saveclubpost(PostRequest $request, $id)
    {

        $user = Auth::user();
        $post = $request['post'];

        $mind = new Post();
        $mind->user_id = $user->id;
        $mind->club_id = $id;
        $mind->post = $post;
        $mind->save();

       \Session::flash('flash_messagex','Post Saved');
         return back();
    }

    // Save User Status
     public function joinclub(Request $request, $id)
    {
        $user = Auth::user();

        $club = new ClubMember();
        $club->user_id = $user->id;
        $club->club_id = $id;
        if(isset($request['iframe'])){
            $club->iframe= $request['iframe'];
        }
        $club->save();

       \Session::flash('flash_messagex','You Have Join the Club');
        $clubs = Club::where('id',$id)->first();
         return redirect()->route('memberclubslug',$clubs->slug);
    }

    // Save User Status
     public function saveebook(Request $request, $id)
    {
        $user = Auth::user();

            $ebook = $request->file('ebook')->getClientOriginalName();
            $destination = base_path() . '/public/Books';
            $request->file('ebook')->move($destination, $ebook);

        $book = new EBook();
        $book->user_id = $user->id;
        $book->club_id = $id;
        $book->file = $ebook;
        $book->save();

       \Session::flash('flash_messagex','Your Ebook was Posted Successfully');
        $clubs = Club::where('id',$id)->first();
         return redirect()->route('memberclubslug',$clubs->slug);
    }


    // Save UClub
     public function saveclub(Request $request)
    {

        $user = Auth::user();
        $title = $request['title'];
        $description = $request['description'];
        $type = $request['type'];
        $url = $request['url'];

        $clb = new Club();
        $clb->user_id = $user->id;
        $clb->title = $title;
        $clb->type = $type;
        $clb->url = $url;
        $clb->description = $description;
        $clb->status = 1;
        $clb->save();

       \Session::flash('flash_messagex','You Have Successfully Created a Club');
         return back();
    }
    
    
}
