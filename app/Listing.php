<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{

    protected $fillable = ['price', 'date'];

    public function property()
    {
      return $this->belongsTo('App\Property');
    }
}
