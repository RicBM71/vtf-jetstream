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

const app = document.getElementById('app');

import auth from "@/Mixins/Auth";
Vue.mixin(auth);

new Vue({
      //finally add this line
      vuetify: new Vuetify(),
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
