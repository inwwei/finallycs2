import router from '@/router'
import axios from '@/libs/axios'
// State object
const state = {
  authorize_code: localStorage.getItem('authorize_code') || null,
  authorize_data: localStorage.getItem('authorize_data') || null,
}

// Getter functions
const getters = {
  getAuthorizeCode: state => state.authorize_code,
  getAuthorizeDate: state => state.authorize_data,
}

// Actions
const actions = {
//   checkAuthorize({ commit, getters }) {
//     return new Promise((resolve, reject) => {
//       const authorize_code = getters.getAuthorizeCode
//       axios.post('/api/setting/device/checkpin', {
//         pin: authorize_code,
//       })
//         .then(({ data }) => {
//           commit('SET_AUTHORIZE_CODE', data.data)
//           resolve(data)
//         })
//         .catch(err => {
//           commit('DEL_AUTHORIZE_CODE')
//           // router.push('/authorize_device')
//           reject(err)
//         })
//     })
//   },
  async loginAuthorize({ commit }, code) {
    try {
      const data = await axios.post('/api/setting/device/usepin', {
        pin: code,
      })
      console.log(data.data.data)
      commit('SET_AUTHORIZE_CODE', data.data.data)
      router.push('/')
    } catch (error) {
      console.log(error)
    }
  },
  logoutAuthorize({ commit }) {
    commit('DEL_AUTHORIZE_CODE')
    router.push('/authorize_device')
  },
}

// Mutations
const mutations = {
  SET_AUTHORIZE_CODE(state, data) {
    state.authorize_code = data.pin
    localStorage.setItem('authorize_code', data.pin)
    localStorage.setItem('authorize_data', JSON.stringify(data))
  },
  DEL_AUTHORIZE_CODE(state) {
    state.authorize_code = null
    localStorage.setItem('authorize_code', null)
    localStorage.setItem('authorize_data', null)
  },
}

export default {
  state,
  getters,
  actions,
  mutations,
}
