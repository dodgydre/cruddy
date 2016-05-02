@extends('layouts.app')

@section('content')

<div class="container" id="properties">
  <div class="col-sm-6">
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
              v-model="property.street"
              v-validate:street="{ required: true }"
            />
            <p v-if="$validation.street.required">Required.</p>
          </div>

          <div class="form-group">
            <input
              class="form-control"
              placeholder="Post Code"
              v-model="property.postcode"
              v-validate:postcode="{ required: true }"
            />
            <p v-show="$validation.postcode.required">Required.</p>

          </div>

          <div class="form-group">
            <input class="form-control" placeholder="MLS ID" v-model="property.mls_id" />
          </div>

          <div class="form-group">
            <input class="form-control" placeholder="hyperlink" v-model="property.hyperlink" />
          </div>

          <button class="btn btn-primary" v-show="$validation.valid " v-on:click="addProperty">Submit</button>

        </div>
      </validator>

    </div>

  </div>

  <!-- Show the Properties -->
  <div class="col-sm-6">
    <ul class="list-group">
      <li href="#" class="list-group-item" v-for="property in properties">
          <h4 class="list-group-item-heading">
            <i class="glyphicon glyphicon-bullhorn"></i>
            @{{ property.street }}
          </h4>
          <h5>
            @{{ property.postcode }}
          </h5>
        <a v-show="property.hyperlink" href="@{{ property.hyperlink }}" class="btn btn-xs btn-primary">Link</a>
        <button class="btn btn-xs btn-danger" v-on:click="deleteProperty($index, property)">Delete</button>
      </li>

    </div>

  </div>
</div>

@endsection


@section('scripts')
  <script src="{{ elixir('js/app.js') }}"></script>

@endsection
