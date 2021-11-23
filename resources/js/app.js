require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
//add these two line
import Vuetify from 'vuetify'
//import Vuetify from 'vuetify/lib'
import 'vuetify/dist/vuetify.min.css'

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

// const opts = {treeShake: true};

// export default new Vuetify(opts)

/*************************
 * VeeValidate
 *************************/
 import VeeValidate from 'vee-validate';
 import VueValidationEs from 'vee-validate/dist/locale/es';
 const config = {
     locale: 'es',
       dictionary: {
           es: VueValidationEs
       }
 };
Vue.use(VeeValidate, config);

//also add this line
Vue.use(Vuetify);

import es from 'vuetify/src/locale/es.ts'

const opts = {
    lang: {
        locales: { es },
        current: 'es',
      },

}

export default new Vuetify(opts)

const app = document.getElementById('app');

import auth from "@/Mixins/Auth";
Vue.mixin(auth);

import comun from "@/Mixins/Comun";
Vue.mixin(comun);

import moment from 'moment'
Object.defineProperty(Vue.prototype, '$moment', {value: moment})

import NProgress from 'nprogress';
import { InertiaProgress } from '@inertiajs/progress';

NProgress.configure({ parent: '#container' });
InertiaProgress.init({
    color: '#37474F',
    }
);

//import Layout from './Layout';
import AppLayout from "@/Layouts/AppLayout";

new Vue({
      //finally add this line
      vuetify: new Vuetify(),
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: function (name){
                    const page = require(`./Pages/${name}`).default
                    //console.log(page.layout);
                    if (page.layout != null || page.layout == undefined)
                        page.layout = page.layout || AppLayout
                    return page
                  }
                //resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
