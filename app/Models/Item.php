<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id',
        'location_id',
        'name',
        'condition',
        'purchase_price',
        'acquired_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
