import router from '@/router'
import axios from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    token: localStorage.getItem('token') || null,
  },
  getters: {
    getToken: state => state.token,
  },
  mutations: {
    SET_TOKEN(state, token) {
      localStorage.setItem('token', token)
      state.token = token
    },
    DEL_TOKEN(state) {
      localStorage.removeItem('token')
      state.token = null
    },
  },
  actions: {
    setToken({ commit }, token) {
      return new Promise((resolve, reject) => {
        console.log(reject)
        const headerToken = `Bearer ${token}`
        commit('SET_TOKEN', headerToken)
        resolve(headerToken)
      })
    },
    checkAuth({ commit, getters }) {
      return new Promise((resolve, reject) => {
        const headerToken = getters.getToken
        axios.get('/api/info', {
          headers: { Authorization: headerToken },
        })
          .then(({ data }) => {
            const userInfo = {
              uid: data.data.id, // From Auth
              displayName: data.data.name, // From Auth
              // photoURL    : require('@/assets/images/portrait/small/avatar-s-11.jpg'), // From Auth
            }
            commit('UPDATE_USER_INFO', userInfo)

            resolve(data)
          })
          .catch(err => {
            commit('DEL_TOKEN')
            reject(err)
          })
      })
    },
    async logout({ commit, getters }) {
      try {
        const headerToken = getters.getToken
        await axios.post(
          '/api/logout',
          {},
          {
            headers: { Authorization: headerToken },
          },
        )
        commit('DEL_TOKEN')
        router.push('/login')
      } catch (error) {
        commit('DEL_TOKEN')
        router.push('/login')
        throw error
      }
    },
  },
}
