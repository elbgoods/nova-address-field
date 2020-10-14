/* global Nova */
Nova.booting((Vue, router, store) => {
  Vue.component('IndexNovaAddressField', require('./components/IndexField'))
  Vue.component('DetailNovaAddressField', require('./components/DetailField'))
  Vue.component('FormNovaAddressField', require('./components/FormField'))
})
