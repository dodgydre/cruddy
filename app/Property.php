<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['street', 'postcode'];

    public function Listings()
    {
        return $this->hasMany('App\Listing');
    }
}
