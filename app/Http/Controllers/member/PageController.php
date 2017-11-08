<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Profile;
use App\Model\Status;
use App\Model\Comment;
use App\Model\Friend;
use App\Model\Club;
use App\Model\Post;
use App\Model\ClubMember;
use Illuminate\Support\Facades\Auth;
use App\Model\EBook;

class PageController extends Controller
{
	public function __construct(){
    $this->middleware('auth');
    }

    // Member Feed Page
     public function feed()
    {
    	$user = Auth::user();
    	$data['mystatus'] = Status::where('user_id',$user->id)->orderBy('id','DESC')->paginate(5);
    	$data['comments'] = Comment::where('user_id', '!=', $user->id)->orderBy('id','DESC')->limit(5)->get();
    	$myfriends = Friend::where('user_id',$user->id)->get();
        $friendprofile = array_pluck($myfriends,'profile_id');
    	$data['newfriends'] = Profile::whereNotIn('id',$friendprofile)->where('user_id', '!=', $user->id)->orderBy('id','DESC')->limit(5)->get();
        return view('member.feed',$data);
    }

    // Member Club Page
     public function club()
    {
    	$user = Auth::user();
        $data['clubs'] = Club::paginate(20);
        return view('member.club',$data);
    }

    // Member Club Page
     public function clubslug($slug)
    {
        $user = Auth::user();
        $data['clubs'] = Club::where('slug',$slug)->first();
        $data['clubpost'] = Post::where('club_id',$data['clubs']->id)->get();
        $data['clubmember'] = ClubMember::where('user_id',$user->id)->where('club_id',$data['clubs']->id)->count();
        $data['member'] = ClubMember::where('user_id',$user->id)->where('club_id',$data['clubs']->id)->first();
        $data['ebooks'] = EBook::where('club_id',$data['clubs']->id)->get();
        
        return view('member.clubslug',$data);
    }

    // Admin Members Page
     public function adminmembers()
    {
    	$user = Auth::user();
        $data['members'] = User::where('role_id',1)->get();
        return view('admin.members',$data);
    }

    // Admin Members Profile Page
     public function profile($id)
    {
        $user = Auth::user();
        $data['members'] = User::where('id',$id)->first();
        return view('admin.profile',$data);
    }

    // Admin Club Page
     public function adminclubs()
    {
        $user = Auth::user();
        $data['clubs'] = Club::orderBy('title','ASC')->get();
        return view('admin.club',$data);
    }

    // Admin Club Page
     public function adminclubspost($id)
    {
        $user = Auth::user();
        $data['clubs'] = Club::where('id',$id)->first();
        $data['clubpost'] = Post::where('club_id',$data['clubs']->id)->orderBy('id','DESC')->get();
        return view('admin.clubpost',$data);
    }

    // Admin Club Page
     public function account()
    {
        $user = Auth::user();
        return view('member.account');
    }

    // Profile Page
     public function memberprofile()
    {
        $user = Auth::user();
        return view('member.profile');
    }
    
    
    
}
