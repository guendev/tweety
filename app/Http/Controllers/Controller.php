<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function responseSuccess($msg, $data = [])
    {
        return response()->json([
            'error' => false,
            'msg' => $msg,
            'data' => $data
        ]);
    }
    public function responseError($msg, $data = [])
    {
        return response()->json([
            'error' => true,
            'msg' => $msg,
            'data' => $data
        ]);
    }
}
