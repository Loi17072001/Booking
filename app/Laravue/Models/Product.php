<?php

namespace App\Laravue\Models;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Product extends Model
{
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'images',
        'name',
        'price',
        'price_discount',
        'group',
        'description',
    ];
    public function groupData()
    {
        return $this->hasOne(Group::class, '_id', 'group');
    }
}
