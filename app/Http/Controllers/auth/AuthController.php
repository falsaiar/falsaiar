<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SignUp;
use App\Http\Requests\SignIn;
use App\Model\User;
use App\Model\Profile;
use Socialite;


class AuthController extends Controller
{
    //
    // Sign In Function
     public function signin(SignIn $request)
    {
        
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                    ->withInput($request->all());
        }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role_id' =>'1', 'active' =>'1', 'verified' =>'1'])) {

            return redirect()->route('memberfeed');
        }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role_id' =>'2', 'active' =>'1', 'verified' =>'1'])) {

            return redirect()->route('adminmembers');
        }


        \Session::flash('flash_message','These credentials do not match our records.');
        return redirect()->back();
    }


    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect()->route('influncerdashboard');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);

    }

    public function registermember(SignUp $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
        ]);

        $fname = $request['fname'];
        $lname = $request['lname'];
        $email = $request['email'];
        $password = bcrypt($request['password']);
        $gender = $request['gender'];

        // Save New User
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->role_id = 1;
        $user->code = strtoupper(str_random(4));
        $user->lastlogin = 0000-00-00;
        $user->provider = '';
        $user->provider_id = '';
        $user->active = 1;
        $user->verified = 1;
        $user->save();

        // Save New Profile
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->fname = $fname;
        $profile->lname = $lname;
        $profile->avatar = 'avatar.png';
        $profile->dob = '';
        $profile->phone = '';
        $profile->country = '';
        $profile->state = '';
        $profile->city = '';
        $profile->description = '';
        $profile->birthplace = '';
        $profile->gender = $gender;
        $profile->occupation = '';
        $profile->profile_id = $user->id.bin2hex(random_bytes(16));
        $profile->fb = '';
        $profile->tw = '';
        $profile->goo = '';
        $profile->club_id = 0;
		$profile->save();

		Auth::login($user);

        return redirect()->route('memberfeed');
    }

    // Logout Function
    public function logout()
    {

        Auth::logout();
        return redirect()->route('index');
    }

}
