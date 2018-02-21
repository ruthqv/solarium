import Vue from 'vue'
import VueRouter from 'vue-router'
import App from '../views/App.vue'
import Shop from '../components/Shop.vue'


Vue.use(VueRouter)
export default new VueRouter({
  mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Shop',
            component: Shop
        },


    ],
});