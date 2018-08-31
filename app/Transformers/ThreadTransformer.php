<?php

namespace App\Transformers;

use App\Models\Thread;
use App\Transformers\UserTransformer;
use App\Transformers\ChannelTransformer;
use League\Fractal\TransformerAbstract;

class ThreadTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user', 'channel'
    ];   

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Thread $thread)
    {
        return [
            'id' => $thread->id,
            'title' => $thread->title,
            'slug' => $thread->slug,
            'body' => $thread->body,
            'diffForHumans' => $thread->created_at->diffForHumans(),
        ];
    }

    public function includeUser(Thread $thread)
    {
        return $this->item($thread->user, new UserTransformer);
    }

    public function includeChannel(Thread $thread)
    {
        return $this->item($thread->channel, new ChannelTransformer);
    }
}
