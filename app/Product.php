<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

    protected $fillable = [
        'name',
        'value',
        'quantity',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
