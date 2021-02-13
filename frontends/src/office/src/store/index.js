import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import ecommerceStoreModule from '@/views/apps/e-commerce/eCommerceStoreModule'
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'
import test from './module/test'
import auth from './auth'
import device from './module/device'
import customer from './module/customer'
import editCustomer from './module/customer/edit'
import infoCustomer from './module/customer/info'
import employee from './module/employee'
import editEmployee from './module/employee/edit'
import product from './module/product'
import orderProduct from './module/product/order'
import addProduct from './module/product/add'
import saleProduct from './module/product/sale/sale'
import printSaleProduct from './module/product/sale/print'
import receive from './module/product/receive'
// import authorize from './module/authorize'
import setting from './module/setting'
import settingBasic from './module/setting/basic'
import settingBasicCompany from './module/setting/basic/company'
import settingBasicBranch from './module/setting/basic/branch'
import settingDevice from './module/setting/basic/device'

Vue.use(Vuex)
export default new Vuex.Store({
  modules: {
    app,
    appConfig,
    verticalMenu,
    'app-ecommerce': ecommerceStoreModule,
    test,
    auth,
    device,
    customer,
    editCustomer,
    infoCustomer,
    employee,
    editEmployee,
    product,
    addProduct,
    orderProduct,
    saleProduct,
    printSaleProduct,
    // authorize,
    setting,
    settingBasic,
    settingBasicCompany,
    settingBasicBranch,
    settingDevice,
    receive,
  },
  strict: process.env.DEV,
})