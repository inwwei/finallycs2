import router from '@/router'

const data = () => ({
  api: '',
  self: '',
  refs: '',
  employee_form: {},
  member_form: {},
  contact_form: {},
  product_form: {},
  open_employee_form: false,
  open_member_form: false,
  open_contact_form: false,
  open_product_form: false,
  clickData: '',
  node: '',
  parent: '',
  index: '',
})
export default {
  namespaced: true,
  state: data(),
  getters: {},
  mutations: {
    SET_API(state, { api, self, refs }) {
      state.api = api
      state.self = self
      state.refs = refs
    },
    SET_EMPOLYEE_SETTING_FORM(state, obj) {
      state.open_employee_form = true
      state.employee_form = obj
    },
    SET_MEMBER_SETTING_FORM(state, obj) {
      state.open_member_form = true
      state.member_form = obj
    },
    SET_CONTACT_SETTING_FORM(state, obj) {
      state.open_contact_form = true
      state.contact_form = obj
    },
    SET_PRODUCT_SETTING_FORM(state, obj) {
      state.open_product_form = true
      state.product_form = obj
    },
    SET_SETTING_NODE(state, { node, parent, index }) {
      state.node = node
      state.parent = parent
      state.index = index
    },
    CLEAR_SETTING_FORM(state) {
      state.employee_form = data().employee_form
      state.member_form = data().member_form
      state.contact_form = data().contact_form
      state.product_form = data().product_form
      state.open_employee_form = false
      state.open_member_form = false
      state.open_contact_form = false
      state.open_product_form = false
    },
  },
  actions: {
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    onClickEmployeeSetting({ commit }, obj) {
      commit('SET_EMPOLYEE_SETTING_FORM', obj)
    },
    onClickMemberSetting({ commit }, obj) {
      commit('SET_MEMBER_SETTING_FORM', obj)
    },
    onClickContactSetting({ commit }, obj) {
      commit('SET_CONTACT_SETTING_FORM', obj)
    },
    onClickProductSetting({ commit }, obj) {
      commit('SET_PRODUCT_SETTING_FORM', obj)
    },
    clearform({ commit }) {
      commit('CLEAR_SETTING_FORM')
    },
  },
}
