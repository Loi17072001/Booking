<?php

namespace App\Laravue\Models;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Group extends Model
{
    protected $table = 'groups';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'images',
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'group', '_id');
    }
}
