<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class DiscoveryController extends Controller
{
    public function get(Request $request)
    {
        $data = User::where('id', '!=', current_user() ? current_user()->id : 0)->orderBy('created_at', 'DESC')
            ->skip(8 * $request['page'])
            ->take(8)
            ->get();
        $list=[];
        foreach ($data as $user){
            $isfollow = current_user() ? current_user()->isFollowing($user) : false;
            $list[] = [
                'id'       => $user->id,
                'user_name'     => $user->user_name,
                'name'      => $user->name,
                'avatar'   => $user->avatar,
                'isFollowing'   => $isfollow,
                'local'    => $user->local,
                'sex'      => $user->sex,
                'count_tweets'  => $user->tweets()->count(),
                'count_follow'  => $user->follower()->count()
            ];
        }
        return $list;
    }
}
