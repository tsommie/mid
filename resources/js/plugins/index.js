import Vue from 'vue'
import { HasError, AlertError, AlertErrors, } from 'vform'

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
