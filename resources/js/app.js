require('./bootstrap');
import Vue from 'vue';
import BiorevApp from './BiorevApp.vue';


new Vue({
    render: h => h(BiorevApp),
}).$mount('#app')
  