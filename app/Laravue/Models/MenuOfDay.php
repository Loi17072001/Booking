<?php

namespace App\Laravue\Models;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class MenuOfDay extends Model
{
    protected $table = 'menu_of_days';
    protected $dates = ['date'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'product_id',
        'price',
        'price_discount',
        'qty',
        'description',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, '_id', 'product_id')->with('groupData');
    }
}
