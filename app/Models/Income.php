<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['description', 'amount', 'date', 'type', 'user_id', 'category'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
