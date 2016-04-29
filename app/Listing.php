<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    public function Property()
    {
      return $this->belongsTo('App\Property')
    }
}
