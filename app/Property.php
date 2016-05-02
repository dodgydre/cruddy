<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['street', 'postcode', 'mls_id', 'hyperlink'];

    public function Listings()
    {
        return $this->hasMany('App\Listing');
    }
}
