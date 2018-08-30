<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function index(Request $request, Channel $channel)
    {
        return 'Thread Index';
    }

    public function show(Thread $thread)
    {
        return 'Thread Show';
    }

    public function store(Request $request, Channel $channel)
    {
        return 'Thread Store';
    }
}
