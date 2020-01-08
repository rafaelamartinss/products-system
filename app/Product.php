<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;

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

    public function routeNotificationForSlack()
    {
        return 'https://hooks.slack.com/services/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';
    }
}
