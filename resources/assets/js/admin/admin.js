require('./bootstrap');

import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use( VueGoogleMaps, {
    load: {
        key: FEMR.googleMapsKey,
        libraries: 'places'
    }
});

let Affix = require('vue-affix');
Vue.use(Affix);

import VeeValidate from 'vee-validate';
Vue.use( VeeValidate, { inject: true } );

Vue.component( 'survey', require( '../front/components/Survey.vue' ) );
Vue.component( 'text-field', require( '../front/components/fields/TextField.vue' ) );
Vue.component( 'textarea-field', require( '../front/components/fields/TextareaField.vue' ) );
Vue.component( 'select-field', require( '../front/components/fields/SelectField.vue' ) );
Vue.component( 'multi-select-field', require( '../front/components/fields/MultiSelectField.vue' ) );

Vue.component('femr-map', require('./components/FemrMap.vue'));
Vue.component('dropdown-menu', require('./components/DropdownMenu.vue'));
Vue.component('menu-item', require('./components/MenuItem.vue'));
Vue.component('menu-form', require('./components/MenuForm.vue'));

const app = new Vue({

    el: '#app',
    data(){

        return {

        }
    },
    methods: {


    },
    mounted(){


        // TODO - Do this better if this admin mobile menu is kept
        let burger = document.querySelector('.nav-toggle');
        let menu = document.querySelector('.nav-menu');
        burger.addEventListener('click', function() {

            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    }
});