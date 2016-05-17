<?php

namespace Suroviy\LaraBox\Models;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;


class LandingBlocks extends Model
{

    use OrderableModel;

    protected $casts = [
        'content' => 'array',
    ];

    public function getOrderField()
    {
        return 'order';
    }

    public function landing()
    {
        return $this->belongsTo('App\Landing');
    }
}