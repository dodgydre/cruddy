var Vue = require('vue');

import Greeter from './components/Greeter.vue';

new Vue({
    el: '#app',
    
    components: { Greeter },
    
    data: {
        items: [
            { message: 'Foo' },
            { message: 'Bar' }
        ]
    }
})