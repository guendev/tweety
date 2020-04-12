<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class TweetActionController extends Controller
{
    public function like(Request $request)
    {
        if (!current_user()){
            return $this->responseError('You cant do it');
        }
        $input = $request->all();
        try {
            current_user()->likeAction($input['tweet_id']);
            return $this->responseSuccess('Like Success', current_user()->checkLike($input['tweet_id']));
        } catch (Exception $e){
            return $this->responseError('Like Failed', current_user()->checkLike($input['tweet_id']));
        }
    }
}
