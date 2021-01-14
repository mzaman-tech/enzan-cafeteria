<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'price', 'image', 'is_available'];

    /**
     * Get the orders for the item.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
