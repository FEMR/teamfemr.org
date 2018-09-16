import * as VueGoogleMaps from 'vue2-google-maps';

Nova.booting((Vue, router) => {

    // TODO -- get API key from .env
    Vue.use( VueGoogleMaps, {
        load: {
            key: '',
            libraries: 'places'
        }
    });

    Vue.component('index-address-field', require('./components/IndexField'));
    Vue.component('detail-address-field', require('./components/DetailField'));
    Vue.component('form-address-field', require('./components/FormField'));
})
