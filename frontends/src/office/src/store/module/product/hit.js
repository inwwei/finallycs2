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
      label: 'จำนวนความต้องการคิดเป็นกิโลกรัม',
      field: 'amount',
      type: 'number',
    },
    {
      label: 'จำนวนร้านที่ต้องการรับซื้อ',
      field: 'sum',
      type: 'number',
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
      console.log(state.products)
    },
  },
  actions: {
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    async getDataHit({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/hit', { timeout: 100000 },
        )
        commit('SET_DATA', data.data)
      } catch (error) {
        throw error
      }
    },

  },
}
