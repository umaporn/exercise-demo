import Vue from 'vue'

//Main pages
import App from './views/app.vue'
import '../css/app.css'

//Import v-from
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const app = new Vue({
	el: '#app',
	components: { App }
});