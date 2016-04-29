@extends('layouts.app')

@section('content')

<div class="container" id="properties">
  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Add a Property</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <input class="form-control" placeholder="Street Address" v-model="property.street" />
        </div>

        <div class="form-group">
          <input class="form-control" placeholder="Post Code" v-model="property.postcode" />
        </div>
        <button class="btn btn-primary" v-on:click="addProperty">Submit</button>

      </div>

    </div>

  </div>

  <!-- Show the Properties -->
  <div class="col-sm-6">
    <div class="list-group">
      <a href="#" class="list-group-item" v-for="property in properties">
        <h4 class="list-group-item-heading">
          <i class="glyphicon glyphicon-bullhorn"></i>
          @{{ property.street }}
        </h4>
        <h5>
          @{{ property.postcode }}
        </h5>

        <button class="btn btn-xs btn-danger" v-on:click="deleteProperty($index, property)">Delete</button>
      </a>

    </div>

  </div>
</div>

@endsection


@section('scripts')
  <script src="{{ elixir('js/app.js') }}"></script>

@endsection
