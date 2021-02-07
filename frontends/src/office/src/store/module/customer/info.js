const master = () => ({
  api: '',
  self: '',
  test1234: 'test',
  dataModelName: '\\App\\Models\\Customer',
  pageLength: 5,
  customer_contact: [],
  info: {},
  columns_customer_contact: [
    {
      label: 'ประเภทข้อมูลติดต่อ',
      field: 'setting_master_contact.name_th',
    },
    {
      label: 'ข้อมูลการติดต่อ',
      field: 'value',
    },
  ],
})
export default {
  namespaced: true,
  state: master(),
  getters: {},
  mutations: {
    SET_API(state, { api, self }) {
      state.api = api
      state.self = self
    },
    SET_CUSTOMER_DATA(state, data) {
      state.info = data
    },
    SET_CUSTOMER_CONTACT_DATA(state, data) {
      state.customer_contact = data
    },
    CLEAR_INFO(state) {
      state.info = master().info
      state.customer_contact = master().customer_contact
    },
  },
  actions: {
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    clearInfo({ commit }) {
      commit('CLEAR_INFO')
    },
    // load Data
    async loadCustomer({ commit, state, dispatch }, id) {
      const customerId = id
      try {
        const { data } = await state.api.get(
          `/api/customers/${customerId}`,
        )
        dispatch('loadCustomerContact', id)
        commit('SET_CUSTOMER_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async loadCustomerContact({ commit, state }, id) {
      const customerId = id
      try {
        const { data } = await state.api.get(
          `/api/customercontacts/${customerId}`,
        )
        commit('SET_CUSTOMER_CONTACT_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
  },
}
