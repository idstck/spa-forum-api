<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Thread;
use App\Http\Requests\Api\CreateThreadRequest;
use App\Transformers\ThreadTransformer;
use App\Http\Requests\Api\GetThreadRequest;

class ThreadController extends Controller
{
    public function index(GetThreadRequest $request, Channel $channel)
    {
        $threads = $channel->find($request->get('channel_id'))->threads()->latestFirst()->get();
        return fractal()
            ->collection($threads)
            ->includeUser()
            ->transformWith(new ThreadTransformer)
            ->toArray();
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
