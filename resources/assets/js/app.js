var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-validator'));

Vue.config.debug = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

var vm = new Vue({
  // We want to target the div with an id of 'events'
  el: '#props',

  // Here we can register any values or collections that hold data
  // for the application
  data: {
    prop: {
      id: '',
      street: '',
      postcode: '',
      mls_id: '',
      hyperlink: ''
    },
    props: [],
    currentProp: '',
    listings: [],
    listing: {
      price: '',
      date: new Date().toISOString().substring(0, 10),
    }
  },

  // Anything within the ready function will run when the application loads
  ready: function() {
    // when the event loads we fetch the properties
    this.fetchProperties();
  },

  // Methods we want to use in our application are registered here
  methods: {
    fetchProperties: function() {
      this.$http.get('api/properties')
        .then(function(response) {
          this.props = response.data;
        }, function(error) {
            console.log(error);
          }
        );
    },

    addProperty: function() {
      if(this.prop.street) {
        var prop_data = this.prop;
        this.$http.post('api/properties', prop_data).then(function(response) {
          this.props.push(prop_data);
          console.log("Property Added!");
        }, function(error) {
          console.log(error);
        });
        this.prop = { id: '', street: '', postcode: '', mls_id: '', hyperlink: '' };
        this.fetchProperties();
      }
    },

    deleteProperty: function(index, prop) {
      if(confirm("Are you sure you want to delete this Property?")) {
        this.$http.delete('api/properties/' + prop.id + '/delete').then(function(response) {
          var deletedProperty = this.props[index];
          this.props.$remove(deletedProperty);
        }, function(error) {
          console.log(error);
        });
      }
    },

    fetchListings: function(prop) {
      this.currentProp = prop;
      this.$http.get('api/' + prop.id + '/listings')
        .then(function(response) {
          this.listings = response.data;
        }, function(error) {
          console.log(error);
        }
      );
    },

    addListing: function(prop) {
      if(this.listing.price) {
        var listing_data = this.listing;
        this.$http.post('api/' + prop.id + '/listings', listing_data).then(function(response) {
          this.listings.push(listing_data);
          console.log("Listing Added!");
        }, function(error) {
          console.log(error);
        });
        this.listing = { price: '', date: new Date().toISOString().substring(0, 10) };
      }
    },
    
    deleteListing: function(index, listing) {
      if(confirm("Are you sure you want to delete this Listing?")) {
        this.$http.delete('api/listings/' + listing.id + '/delete').then(function(response) {
          var deletedListing = this.listing[index];
          this.listings.$remove(deletedListing);
        }, function(error) {
          console.log(error);
        });
      }
    }
  }
});

window.vue = vm;
