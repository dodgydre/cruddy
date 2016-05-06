<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Listing;
use App\Property;

class ListingController extends Controller
{
    
    public function listingsIndex($prop_id)
    {
      return Property::find($prop_id)->listings;
    }
    
    public function listingsStore($prop_id, Request $request)
    {
      $listing = new Listing([
        'price' => $request->price,
        'date'  => $request->date
      ]);
      $property = Property::find($prop_id);
      return $property->listings()->save($listing);
    }
    
    public function listingsDelete($listing_id)
    {
        Listing::find($listing_id)->delete();

        return 'deleted';
    }
}
