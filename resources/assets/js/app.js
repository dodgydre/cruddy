var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

var vm = new Vue({
  // We want to target the div with an id of 'events'
  el: '#properties',

  // Here we can register any values or collections that hold data
  // for the application
  data: {
    property: {
      street: '',
      postcode: ''
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
        this.$http.post('api/properties/', this.property).then(function(response) {
          this.properties.push(this.property);
          console.log("Property Added!");
        }, function(error) {
          console.log(error);
        });
        this.property = { street: '', postcode: '' };
      }
    },

    deleteProperty: function(index, property) {
      if(confirm("Are you sure you want to delete this Property?")) {
        //console.log(index);
        this.$http.delete('api/properties/' + property.id).then(function(response) {
          var deletedProperty = this.properties[index];
          this.properties.$remove(property.id);
        }, function(error) {
          console.log(error);
        });
      }
    }

  }
});

window.vue = vm;
