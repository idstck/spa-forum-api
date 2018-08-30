<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ChannelTransformer;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index(Channel $channel)
    {
        return fractal()
            ->collection($channel->get())
            ->transformWith(new ChannelTransformer)
            ->toArray();
    }
}
