require('./bootstrap');

// import store from './store';

// Register the map component
Vue.component('femr-map', require('./components/FemrMap.vue'));
Vue.component('school-form', require('./components/schools/SchoolForm.vue'));

// TODO -- probably a more specific name for this
Vue.component('dropdown-menu', require('./components/DropdownMenu.vue'));
Vue.component('menu-item', require('./components/MenuItem.vue'));
Vue.component('menu-form', require('./components/MenuForm.vue'));

const app = new Vue({
    // store,
    el: '#app',
    data(){

        return {

        }
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