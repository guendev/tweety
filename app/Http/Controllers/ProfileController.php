<?php


namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function index(User $user){
        $data = $this->getProfileData($user->id, 5, 0);
        $profile_data = $this->getNewsFeed($data);
        $follow_data=[];
        $follow_data['count_following'] = $user->following()->count();
        $follow_data['count_follower'] = $user->follower()->count();
        $follow_data['samefollow'] = $user->sameFollow();
        return view('layouts.profile.index', compact('user', 'profile_data', 'follow_data'));
    }

    public function infinity(Request $request)
    {
        $input = $request->all();
        if (isset($input['user_id']) && $input['user_id'] > 0){
            $limit = 5;
            $page = isset($input['page']) ? (int)$input['page'] : 1;
            $user_id = $input['user_id'];
            $data = $this->getProfileData($user_id, $limit, $page);
            return $this->getNewsFeed($data);
        }
        return false;
    }

    public function edit(User $user){
        try {
            $this->authorize('edit', $user);
        } catch (AuthorizationException $e) {
            return redirect(route('tweets'));
        }
        return view('layouts.profile.edit', compact('user'));
    }

    /**
     * @param $user_id
     * @param int $limit
     * @param int $page
     * @return mixed
     */
    public function getProfileData($user_id, int $limit, int $page)
    {
        return Tweet::where('user_id', $user_id)
            ->orderBy('created_at', 'DESC')
            ->skip($limit * $page)
            ->take($limit)
            ->get();
    }

    public function getUserInfo(Request $request){
        $input = $request->all();
        return User::find($input['user_id']);
    }

    public function update(Request $request)
    {
        $input = $request['params']['data'];

        if (current_user()->id == $input['id']){
            current_user()->update($input);
        }

        return $this->responseSuccess('', current_user());
    }


    public function changePassword(Request $request)
    {

        if(!auth()->check())
        {
            return $this->responseError('Update Failed');
        }
        $input = $request->all();
        if (Hash::check($input['oldPass'], current_user()->password)){
            current_user()->password = Hash::make($input['newPass']);
            current_user()->save();
            return $this->responseSuccess('Update Success');
        }
        return $this->responseError('Update Failed');
    }

    public function changeProfileImg(Request $request)
    {
        if(!auth()->check())
        {
            return $this->responseError('Update Failed');
        }
        /*try {*/
            $Url=[];
            $Url = $this->saveImg($request, 'avatar' ,$Url, 200);
            $Url = $this->saveImg($request, 'cover' ,$Url, 617);
            return $this->responseSuccess('Update Success', $Url);
        /*}catch (\Exception $exception){
            return $this->responseError('Update Failed');
        }*/
    }

    /**
     * @param Request $request
     * @param string $type
     * @param array $Url
     * @param int $width
     * @return array
     */
    public function saveImg(Request $request, string $type , array $Url, int $width): array
    {
        if (isset($request[$type]) && $request->validate([$type => ['required', 'file']])) {
            $directory = 'img/'.$type.'/';
            $fileName = rand(0, 9999999). time() .'_'. $type . '.jpg';
            $Url[$type] = $directory.$fileName;
            Image::make($request[$type])->encode('jpg')->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($Url[$type]);
            //$Url[$type] = $request[$type]->store($type.'s');
            current_user()->$type = $Url[$type];
            current_user()->save();
        }
        return $Url;
    }

}
