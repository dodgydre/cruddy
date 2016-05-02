var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-validator'));

Vue.config.debug = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

var vm = new Vue({
  // We want to target the div with an id of 'events'
  el: '#properties',

  // Here we can register any values or collections that hold data
  // for the application
  data: {
    property: {
      street: '',
      postcode: '',
      mls_id: '',
      hyperlink: ''
    },
    properties: [],
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
          this.properties = response.data;
        }, function(error) {
            console.log(error);
          }
        );
    },

    addProperty: function() {
      if(this.property.street) {
        var prop_data = this.property;
        this.$http.post('api/properties/', prop_data).then(function(response) {
          this.properties.push(prop_data);
          console.log("Property Added!");
        }, function(error) {
          console.log(error);
        });
        this.property = { street: '', postcode: '', mls_id: '', hyperlink: '' };
      }
    },

    deleteProperty: function(index, property) {
      if(confirm("Are you sure you want to delete this Property?")) {
        //console.log(index);
        this.$http.delete('api/properties/' + property.id).then(function(response) {
          var deletedProperty = this.properties[index];
          this.properties.$remove(deletedProperty);
        }, function(error) {
          console.log(error);
        });
      }
    }

  }
});

window.vue = vm;
