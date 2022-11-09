require('./bootstrap');
import Vue from 'vue';
import BiorevApp from './BiorevApp.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueToast from 'vue-toast-notification';
import { faUserSecret, faCheck, faPaperclip, faAngleDown, faAngleUp, faInfoCircle } from '@fortawesome/free-solid-svg-icons'
import VueSweetalert2 from 'vue-sweetalert2';
import VueTidio from 'vue-tidio'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

library.add(faUserSecret, faCheck, faAngleDown, faAngleUp, faPaperclip, faInfoCircle)

import 'vue-toast-notification/dist/theme-sugar.css';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.component('fa-icon', FontAwesomeIcon);
Vue.component('v-select', vSelect);
Vue.prototype.$host = document.querySelector('meta[name="url"]').content;
Vue.prototype.$media = document.querySelector('meta[name="media_url"]').content;

Vue.use(VueSweetalert2);

Vue.use(VueToast, {
    position: 'top-right',
    duration:4000,
});
if(process.env.MIX_TIDIO_API_KEY) {
    Vue.use(VueTidio, { appKey: process.env.MIX_TIDIO_API_KEY });
}

Vue.config.productionTip = false;

new Vue({
    render: h => h(BiorevApp),
}).$mount('#app')
  