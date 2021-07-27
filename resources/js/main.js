import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import BootstrapVue from 'bootstrap-vue'
import VueTour from 'vue-tour'
import Countdown from 'vue-awesome-countdown'
import Axios from 'axios'
import VueAxios from 'vue-axios'
import Vuelidate from 'vuelidate'
import { responsive } from './plugins/responsive/responsive'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue-tour/dist/vue-tour.css'
// import './registerServiceWorker'

Vue.use(BootstrapVue)
Vue.use(VueTour)
Vue.use(Countdown)
Vue.use(responsive)
Vue.use(VueAxios, Axios)
Vue.use(Vuelidate)

Vue.router = router // Just for vue-auth
Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  authRedirect: { path: '/auth/login' },
  logoutData: { url: 'auth/logout', method: 'POST', redirect: '/auth/login', makeRequest: true },
  refreshData: { enabled: false },
  parseUserData (data) {
    if (data.success) {
      console.log('User fetched', data)
      return data.user
    }
  },
  tokenExpired (data) {
    return false
  }
})

Vue.axios.defaults.baseURL = 'http://testme-pk.test/api'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
