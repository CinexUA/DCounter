import Vue from 'vue'
import store from '../store'
import Meta from 'vue-meta'
import routes from './routes'
import Router from 'vue-router'
import {sync} from 'vuex-router-sync'

Vue.use(Meta)
Vue.use(Router)


const router = createRouter()

sync(store, router)

export default router

/**
 * Create a new router instance.
 *
 * @return {VueRouter}
 */
function createRouter () {
    return new Router({
        scrollBehavior,
        mode: 'history',
        routes
    })
}



/**
 * Scroll Behavior
 *
 * @link https://router.vuejs.org/en/advanced/scroll-behavior.html
 *
 * @param  {Route} to
 * @param  {Route} from
 * @param  {Object|undefined} savedPosition
 * @return {Object}
 */
function scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
        return savedPosition
    }

    if (to.hash) {
        return { selector: to.hash }
    }

    const [component] = router.getMatchedComponents({ ...to }).slice(-1)

    if (component && component.scrollToTop === false) {
        return {}
    }

    return { x: 0, y: 0 }
}
