<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     /**
     * Error respond
     * @param  string $message
     * @param  int $code
     * @return \Illuminate\Http\Response
     */
    protected function jsonErrorRespond($message, $code)
    {
        return response()->json([
            'success' => false,
            'message' => trans($message)
        ], $code);
    }
}
