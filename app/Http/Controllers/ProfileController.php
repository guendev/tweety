<?php


namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

class ProfileController extends Controller
{
    public function index(User $user){
        $data = $this->getProfileData($user->id, 5, 0);
        $profile_data = $this->getNewsFeed($data);
        $follow_data=[];
        $follow_data['count_following'] = $user->following()->count();
        $follow_data['count_follower'] = $user->follower()->count();
        $follow_data['follow'] = $user->sameFollow();
        //return ddd($follow_data);
        return view('layouts.profile.index', compact('user', 'profile_data', 'follow_data'));
    }

    public function infinity(Request $request)
    {
        $input = $request->all();
        if (isset($input['user_id']) && $input['user_id'] > 0){
            $limit = 5;
            $page = isset($input['page']) ? (int)$input['page'] : 1;
            $user_id = $input['user_id'];
            return $this->getProfileData($user_id, $limit, $page);
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
}
