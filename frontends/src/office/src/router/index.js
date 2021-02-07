import Vue from 'vue'
import VueRouter from 'vue-router'

// Routes
import { canNavigate } from '@/libs/acl/routeProtection'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from '@/auth/utils'
import store from '../store'
import apps from './routes/apps'
import dashboard from './routes/dashboard'
import uiElements from './routes/ui-elements/index'
import pages from './routes/pages'
import chartsMaps from './routes/charts-maps'
import formsTable from './routes/forms-tables'
import others from './routes/others'
import customer from './routes/customer'
import employee from './routes/employee'
import product from './routes/product'
import setting from './routes/setting'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    { path: '/', redirect: { name: 'home' } },
    ...apps,
    ...dashboard,
    ...pages,
    ...chartsMaps,
    ...formsTable,
    ...uiElements,
    ...others,
    ...customer,
    ...employee,
    ...product,
    ...setting,
    {
      path: '*',
      redirect: 'error-404',
    },
    {
      path: '/authorize_device',
      name: 'authorize_device',
      component: () => import('@/views/AuthorizeDevice.vue'),
      meta: {
        layout: 'full',
        // redirectIfLoggedIn: true,
      },
    },
    {
      path: '/test',
      name: 'test',
      component: () => import('@/views/Test.vue'),
    },
    {
      path: '/home',
      name: 'home',
      component: () => import('@/views/Home.vue'),
    },
  ],
})

router.beforeEach(async (to, _, next) => {
  // ตรวจ authorize code ก่อนว่าเครื่องได้รับอนุญาติ หรือไม่
  try {
    await store.dispatch('checkAuthorize')
  } catch (e) {
    //
  }

  if (to.path === '/authorize_device') {
    return next()
  }

  if (store.getters.getAuthorizeCode === null) {
    router.push('/authorize_device')
  }

  const isLoggedIn = isUserLoggedIn()

  if (!canNavigate(to)) {
    // Redirect to login if not logged in
    if (!isLoggedIn) return next({ name: 'auth-login' })

    // If logged in => not authorized
    return next({ name: 'misc-not-authorized' })
  }

  // Redirect if logged in
  if (to.meta.redirectIfLoggedIn && isLoggedIn) {
    const userData = getUserData()
    next(getHomeRouteForLoggedInUser(userData ? userData.role : null))
  }

  return next()
})

export default router
