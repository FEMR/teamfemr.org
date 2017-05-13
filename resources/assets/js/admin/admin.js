require('./bootstrap');

import "select2"
// import store from './store';

// Register the map component
Vue.component('femr-map', require('./components/FemrMap.vue'));
Vue.component('school-form', require('./components/schools/SchoolForm.vue'));

// TODO -- probably a more specific name for these?
Vue.component('dropdown-menu', require('./components/DropdownMenu.vue'));
Vue.component('menu-item', require('./components/MenuItem.vue'));
Vue.component('menu-form', require('./components/MenuForm.vue'));

const app = new Vue({
    // store,
    el: '#app',
    components: {},
    data(){

        return {

        }
    },
    methods: {


    },
    mounted(){


        // TODO - Do this better if this admin mobile menu is kept
        var burger = document.querySelector('.nav-toggle');
        var menu = document.querySelector('.nav-menu');
        burger.addEventListener('click', function() {

            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    }
});


//
// jQuery stuff so I can get things working faster while learning how to use Vue
//
$( function() {

    $( '.select2' ).select2({

        tags: true,
        tokenSeparators: [',', ' ']
    });
});