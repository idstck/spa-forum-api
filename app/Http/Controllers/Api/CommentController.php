<?php

namespace App\Http\Controllers\Api;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCommentRequest;
use App\Transformers\CommentTransformer;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request, Thread $thread)
    {
        $comment = $thread->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->json('body')
        ]);

        return fractal()
            ->item($comment)
            ->includeUser()
            ->transformWith(new CommentTransformer)
            ->toArray();

    }
}
