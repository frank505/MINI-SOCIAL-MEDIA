<?php

namespace  App\Helpers;

//

class HttpResponseHelper
{

    public static function Response($state,$message,$data,$responseStatus)
    {
        return response()->json([
            'success'=>$state,
            'message'=>$message,
            'data'=>$data
        ],$responseStatus);
    }

}
