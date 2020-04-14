<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (Auth::guard('web')
                ->attempt([
                    'email'     =>  $request['email'],
                    'password'  =>  $request['pass']
                ]))
            {
                $user = User::where('email', $request['email'])->first();
                Auth::login($user, $request['remember']);
                return true;
            }
        } catch (\Exception $exception){
            return false;
        }
        return false;
    }

    public function register(Request $request)
    {
        if (Auth::guard('web')->check()){
            return $this->responseError('Register failed !!', false);
        }
        try {
            $input = $request->all();
            $email = $input['email'];
            if (User::where('email', $email)->first()){
                return $this->responseError('Email has been use !!');
            }
            $user_name = $input['user_name'];
            if (User::where('user_name', $user_name)->first()){
                return $this->responseError('Username has been use');
            }
            $user = new User();
            $user->name = $input['name'];
            $user->user_name = $input['user_name'];
            $user->email = $input['email'];
            $user->password = Hash::make($input['pass']);

            if ($user->save()){
                Auth::login($user, true);
                return $this->responseSuccess('Register completed', current_user());
            }
        }catch (\Exception $exception){
            return $this->responseError('Register failed !');
        }
        return $this->responseError('Register failed !');
    }
}
