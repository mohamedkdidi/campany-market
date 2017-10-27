import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {path: '/', component: require('./views/dashboard/index.vue')},
        {path: '/profile', component: require('./views/profile/index.vue')},

        
        {path: '/stock', component: require('./views/stock/index.vue')},
        {path: '/stock/create', component: require('./views/stock/form.vue')},
        {path: '/stock/:id/edit', component: require('./views/stock/form.vue'), meta: {mode: 'edit'}},
        {path: '/stock/:id', component: require('./views/stock/show.vue')},

        {path: '/companie', component: require('./views/companie/index.vue')},
        {path: '/companie/create', component: require('./views/companie/form.vue')},
        {path: '/companie/:id/edit', component: require('./views/companie/form.vue'), meta: {mode: 'edit'}},
        {path: '/companie/:id', component: require('./views/companie/show.vue')},
    ]
})

export default router