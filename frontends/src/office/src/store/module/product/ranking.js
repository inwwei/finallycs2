import router from '@/router'

const data = () => ({
  api: '',
  self: '',
  refs: '',
  test: '',
  company_id: '',
  company_info: {},

  form_add: {
    user_id: '123456789',
    Plant_select: '',
    first_date: '',
    end_date: '',
    name: '',
    moisture: '',
    moisture_min: '',
    moisture_max: '',
    Foreign_matter: '',
    price_per_kk: '',
    price_per_ton: '',
  },
  products: [],
  columns: [
    {
      label: 'ชื่อ',
      field: 'name',
    },
    {
      label: 'อัตราการเติบโต ( 1 = 100 %)',
      field: 'sum',
    },

  ],
  columns_menu: [
    {
      label: 'ชื่อ',
      field: 'name',
      sortable: false,
    },
    {
      label: 'ราคา/กก.',
      field: 'price_per_kk',
      type: 'number',
    },
    {
      label: 'หักความชื้น (ร้อยละ)',
      field: 'moisture',
      type: 'number',
    },
    {
      label: 'ความชื้นต่ำสุด',
      field: 'moisture_min',
      type: 'number',
    },
    {
      label: 'ความชื้นสูงสุด',
      field: 'moisture_max',
      type: 'number',
    },
    {
      label: 'หักสิ่งแปลกปลอม (ร้อยละ)',
      field: 'Foreign_matter',
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
    },
    SET_ALL(state, data) {
      state.user_all_data = data
    },
    SET_ID(state, id) {
      state.company_id = id
    },
    SET_BRANCH_ID(state, product_info) {
      state.product_info.setting_basic_branch_id = product_info.setting_basic_branch.id
    },
  },
  actions: {
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    async getDataRank({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/ranking',
        )
        commit('SET_DATA', data.data)
      } catch (error) {
        throw error
      }
    },

  },
}
