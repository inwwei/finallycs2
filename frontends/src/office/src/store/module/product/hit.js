import router from '@/router'

const data = () => ({
  api: '',
  self: '',
  refs: '',
  test: '',
  products: [],
  columns: [
    {
      label: 'ชื่อ',
      field: 'name',
    },
    {
      label: 'จำนวนความต้องการ',
      field: 'sum',
    },

  ],
})
export default {
  namespaced: true,
  state: data(),
  getters: {
  },
  mutations: {
    SET_API(state, {
      api, self, refs,
    }) {
      state.api = api
      state.self = self
      state.refs = refs
    },
    SET_DATA(state, data) {
      state.products = data
    },
  },
  actions: {
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    async getDataHit({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/hit',
        )
        commit('SET_DATA', data.data)
      } catch (error) {
        throw error
      }
    },

  },
}
