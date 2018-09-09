Nova.booting((Vue, router) => {
    Vue.component('index-text-field', require('./components/IndexField'));
    Vue.component('detail-text-field', require('./components/DetailField'));
    Vue.component('form-text-field', require('./components/FormField'));
})
