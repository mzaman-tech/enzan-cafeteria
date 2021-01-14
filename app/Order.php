<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'quantity', 'total_price', 'customer_name', 'customer_addess', 'delivery_time', 'is_delivered'];

    /**
     * Get the item that owns the order.
     */
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

}
