<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Thread;
use App\Http\Requests\Api\CreateThreadRequest;
use App\Transformers\ThreadTransformer;

class ThreadController extends Controller
{
    public function index(Request $request, Channel $channel)
    {
        return 'Thread Index';
    }

    public function show(Thread $thread)
    {
        return fractal()
            ->item($thread)
            ->includeUser()
            ->transformWith(new ThreadTransformer)
            ->toArray();
    }

    public function store(CreateThreadRequest $request, Channel $channel)
    {
        $thread = $request->user()->threads()->create([
            'channel_id' => $request->json('channel_id'),
            'title' => $request->json('title'),
            'slug' => str_slug($request->json('title'), '-'),
            'body' => $request->json('body'),
        ]);

        return fractal()
            ->item($thread)
            ->includeUser()
            ->includeChannel()
            ->transformWith(new ThreadTransformer)
            ->toArray();
    }
}
