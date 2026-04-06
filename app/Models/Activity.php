<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'item_id',
        'action_type',
        'description',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
