<?php

namespace App\Transformers;

use App\Models\Channel;
use League\Fractal\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Channel $channel)
    {
        return [
            'id' => $channel->id,
            'title' => $channel->title,
            'slug' => $channel->slug,
            'description' => $channel->slug
        ];
    }
}
