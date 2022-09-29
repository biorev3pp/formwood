require('./bootstrap');
import Vue from 'vue';
import BiorevApp from './BiorevApp.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { faCheck } from '@fortawesome/free-solid-svg-icons'
import { faPaperclip } from '@fortawesome/free-solid-svg-icons'
import { faAngleDown } from '@fortawesome/free-solid-svg-icons'

library.add(faUserSecret, faCheck, faAngleDown, faPaperclip)
Vue.component('fa-icon', FontAwesomeIcon)

new Vue({
    render: h => h(BiorevApp),
}).$mount('#app')
  