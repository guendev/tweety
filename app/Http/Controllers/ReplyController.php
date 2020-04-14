<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Exception;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    //
    public function replies(Request $request)
    {
        $input = $request->all();
        $replies =  Reply::where('tweet_id', $input['tweet_id'])->orderBy('created_at', 'DESC')->get();
        return $this->repliesInfo($replies);
    }

    public function create(Request $request)
    {
        if (!current_user()){
            return $this->responseError('Reply Failed');
        } else {
            $input = $request->all();
            try {
                Reply::create([
                    'user_id'   =>  current_user()->id,
                    'tweet_id'  =>  $input['tweet_id'],
                    'content'   =>  $input['content']
                ]);
                return $this->responseSuccess('Post reply seccuess! ');
            } catch (Exception $exception){
                return $this->responseError('Post reply failed!');
            }
        }
    }

    /**
     * @param $replies
     * @return array
     */
    public function repliesInfo($replies): array
    {
        $data = [];
        foreach ($replies as $reply) {
            $data[] = [
                'id' => $reply->id,
                'author_name' => $reply->author->name,
                'author_user_name' => $reply->author->user_name,
                'author_avatar' => $reply->author->avatar,
                'content' => $reply->content,
                'created_at' => $reply->created_at
            ];
        }
        return $data;
    }
}
