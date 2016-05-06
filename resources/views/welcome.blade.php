@extends('layouts.app')

@section('content')

<div class="container" id="props">

  <div class="row">
    
    
    <div class="col-sm-6">
    
    <!-- Add a Property Panel -->
    
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Add a Property</h3>
        </div>
        <validator name="validation">
          <div class="panel-body">
            <div class="form-group">
              <input
                class="form-control"
                placeholder="Street Address"
                v-model="prop.street"
                v-validate:street="{ required: true }"
              />
              <p v-if="$validation.street.required">Required.</p>
            </div>

            <div class="form-group">
              <input
                class="form-control"
                placeholder="Post Code"
                v-model="prop.postcode"
                v-validate:postcode="{ required: true }"
              />
              <p v-show="$validation.postcode.required">Required.</p>

            </div>

            <div class="form-group">
              <input class="form-control" placeholder="MLS ID" v-model="prop.mls_id" />
            </div>

            <div class="form-group">
              <input class="form-control" placeholder="hyperlink" v-model="prop.hyperlink" />
            </div>

            <button class="btn btn-primary" v-show="$validation.valid " v-on:click="addProperty">Submit</button>

          </div>
        </validator>

      </div>
      <br />

    <!-- Add a Listing Panel -->


      <div v-if="currentProp == ''">
        No Property Selected
      </div>
      <div v-else>
        <h3>Listings for: @{{ currentProp.street }}</h3>
        <ul class="list-group">
          <li class="list-group-item" v-for="listing in listings">
            @{{ listing.date }} : $ @{{ listing.price }}
            <button class="btn btn-xs btn-danger" v-on:click="deleteListing($index, listing)">Delete Listing</button>
          </li>
        </ul>
        <h3>Add new listing</h3>
        <validator name="listing_validation">
          <input
            class="form-control"
            placeholder="Price"
            v-model="listing.price"
            v-validate:price="{ required: true, numeric: true }"
          />
          <p v-show="$listing_validation.price.required">Required.</p>

          <input
            class="form-control"
            type="date"
            placeholder="Date"
            v-model="listing.date"
            v-validate:date="{ required: true }"
          />
          <p v-show="$listing_validation.date.required">Required.</p>


          <button class="btn btn-primary" v-show="$listing_validation.valid " v-on:click="addListing(currentProp)">Add Listing</button>
        </validator>
      </div>

    </div> <!-- /.col-sm-6 -->

    <!-- Show the Properties -->
    <div class="col-sm-6">
      <ul class="list-group">
        <li class="list-group-item" v-for="prop in props">
          <div @click="fetchListings(prop)">
            <h4 class="list-group-item-heading">
              <i class="glyphicon glyphicon-home"></i>
              @{{ prop.street }}
            </h4>
            <h5>
              @{{ prop.postcode }}
            </h5>
          </div>
          <a v-show="prop.hyperlink" href="@{{ prop.hyperlink }}" class="btn btn-xs btn-primary">Link</a>
          <button class="btn btn-xs btn-danger" v-on:click="deleteProperty($index, prop)">Delete</button>
        </li>
      </ul>
    </div>
  </div>

</div> <!-- /.container -->

@endsection


@section('scripts')
  <script src="{{ elixir('js/app.js') }}"></script>

@endsection
