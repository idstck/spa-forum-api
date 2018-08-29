<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return fractal()
                ->item($request->user())
                ->transformWith(new UserTransformer)
                ->toArray();
    }
}
