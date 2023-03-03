<?php

namespace App\Traits;

trait HttpResponses
{

    protected function success($data, $message = null, $code = 200)
    {
        return response()->json(
            [
                'status'=>'Request was Successful',
                'message'=>$message,
                'data'=>$data
            ]
        );
        
    }

    protected function error($data, $message = null, $code)
    {
        return response()->json(
            [
                'status' => 'Error has Occured',
                'message' => $message,
                'data' => $data
            ]
        );
    }
}
