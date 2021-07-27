<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefreshController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return response($user->regenerateToken());
    }
}
