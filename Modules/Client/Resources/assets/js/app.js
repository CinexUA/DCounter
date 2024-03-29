import Vue from 'vue'
import store from './store'
import router from './router'
import i18n from './plugins/i18n'
import App from './components/App'

import './plugins'
import './components'

// create a new Event Bus Instance
window.Fire = new Vue();

Vue.config.productionTip = true

/* eslint-disable no-new */
new Vue({
    i18n,
    store,
    router,
    ...App
})
