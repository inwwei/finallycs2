import Vue from 'vue'

// axios
import axios from 'axios'

const domain = process.env.VUE_APP_API_BASEURL
const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: domain,
  timeout: 1000,
  headers: { 'X-Custom-Header': 'foobar' },
})

Vue.prototype.$http = axiosIns

export default axiosIns
