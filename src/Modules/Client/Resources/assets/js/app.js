import Vue from 'vue'
import store from './store'
import router from './router'
import App from './components/App'

import './plugins'
import './components'

// create a new Event Bus Instance
window.Fire = new Vue();

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    store,
    router,
    ...App
})
