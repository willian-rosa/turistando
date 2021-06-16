import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Eventos from './components/Eventos.vue'
import List from './components/listas/List.vue'
import PontosTuristicos from './components/PontosTuristicos.vue'
import Elementos from './components/Elementos.vue'
import Teste from './components/Teste.vue'
import Estabelecimentos from './components/Estabelecimentos.vue'
import VueHorizontal from 'vue-horizontal';
import * as VueGoogleMaps from 'vue2-google-maps'


import './registerServiceWorker'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueGoogleMaps,{
  load:{
    key:'AIzaSyBvb87D9piABnnlhDHR3xg8oiSvMq2vE_I',
    libraries: 'places',
  }
})
Vue.use(VueHorizontal);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.config.productionTip = false
Vue.use(VueRouter)

const routes = [
  { path: '/', component: Eventos },
  { path: '/elementos', component: Elementos },
  { path: '/list', component: List },
  { path: '/teste', component: Teste },
  { path: '/pontosturisticos', component: PontosTuristicos },
  { path: '/estabelecimentos', component: Estabelecimentos }
]
const router = new VueRouter({
  routes 
})

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
