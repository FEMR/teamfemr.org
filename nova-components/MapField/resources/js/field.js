Nova.booting((Vue, router) => {
    Vue.component('index-MapField', require('./components/IndexField'));
    Vue.component('detail-MapField', require('./components/DetailField'));
    Vue.component('form-MapField', require('./components/FormField'));
})
