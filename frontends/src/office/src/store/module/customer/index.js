import router from '@/router'

const master = () => ({
  api: '',
  self: '',
  refs: '',
  show_modal: true,
  dataModelId: '',
  dataModelName: '\\App\\Models\\Customer',
  pageLength: 5,
  columns_customer_contact: [
    {
      label: 'ประเภทข้อมูลติดต่อ',
      field: 'type',
    },
    {
      label: 'ข้อมูลการติดต่อ',
      field: 'value',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  option: [],
  columns: [
    {
      label: 'ชื่อ',
      field: 'customer_name',
    },
    {
      label: 'หมายเลยเสียภาษี',
      field: 'tax_id',
    },
    {
      label: 'ข้อมูลติดต่อ',
      field: 'customer_contacts',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  customers: [],
  status: [{
    1: 'Current',
    2: 'Professional',
    3: 'Rejected',
    4: 'Resigned',
    5: 'Applied',
  },
  {
    1: 'light-primary',
    2: 'light-success',
    3: 'light-danger',
    4: 'light-warning',
    5: 'light-info',
  }],
  add: {
    option: [],
    selected: 'เลือกสาขา',
    customer_name: '',
    tax_id: '',
    identification_number: '',
    setting_master_customer_id: '',
    setting_basic_branch_id: '',
    setting_master_contact_id: '',
    customer_contact: [],
  },
  customer_contact: {},
})
export default {
  namespaced: true,
  state: master(),
  getters: {},
  mutations: {
    SET_TYPE_CONTACT(state, node) {
      state.customer_contact.type = node.name_th
    },
    INSERT_CUSTOMER_CONTACT(state) {
      state.show_modal = false
    },
    SET_API(state, { api, self }) {
      state.api = api
      state.self = self
    },
    SET_REFS(state, refs) {
      state.refs = refs
    },
    SET_BRANCH_DATA(state, data) {
      state.add.option = data
    },
    SET_CUSTOMER_DATA(state, data) {
      state.customers = data
    },
    SET_MODEL_ID(state, data) {
      state.dataModelId = data
    },
    CLEAR_ADD_CUSTOMER_FORM(state) {
      state.add = master().add
      state.dataModelId = master().dataModelId
    },
    SET_CUSTOMER_CONTACT(state, data) {
      state.customer_contact.full_value = `${state.customer_contact.value ?? ''}  ${state.customer_contact.house_number ?? ''} ${state.customer_contact.district ?? ''} ${state.customer_contact.amphure ?? ''} ${state.customer_contact.province ?? ''} ${state.customer_contact.postal_code ?? ''}`
      state.customer_contact.setting_master_contact_id = state.add.setting_master_contact_id
      state.add.customer_contact.push({ ...state.customer_contact })
    },
    CLEAR_CUSTOMER_CONTACT(state, data) {
      state.customer_contact = master().customer_contact
    },
    DELETE_CONTACT(state, index) {
      state.add.customer_contact.splice(index, 1)
    },
  },
  actions: {
    backToIndex({ commit }) {
      commit('CLEAR_ADD_CUSTOMER_FORM')
      router.push({ name: 'customerIndex', query: { } })
    },
    deleteContact({ commit, state }, index) {
      commit('DELETE_CONTACT', index)
    },
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    editCustomer(state, id) {
      router.push({ name: 'customerEdit', query: { id } })
    },
    infoCustomer(state, id) {
      router.push({ name: 'customerInfo', query: { id } })
    },
    setRefs({ commit }, refs) {
      commit('SET_REFS', refs)
    },
    async deleteCustomer({ state, dispatch }, data) {
      state.self.$swal({
        title: 'ลบข้อมูลสมาชิก',
        text: `คุณต้องการลบข้อมูลสมาชิก ${data.customer_name} ใช่หรือไม่?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          state.api.delete(
            `/api/customers/${data.id}`,
          )
          state.self.$swal({
            icon: 'success',
            title: 'ลบข้อมูลสมาชิกสำเร็จ',
            text: `ข้อมูลสมาชิก ${data.customer_name} ถูกลบสำเร็จ`,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(result => {
            if (result.value) {
              dispatch('queryCustomerData')
            }
          })
        }
      })
    },
    async loadBranch({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/setting/basic/branch',
        )
        commit('SET_BRANCH_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async insertCustomerContact({ commit, state }) {
    //   commit('INSERT_CUSTOMER_CONTACT')
      commit('SET_CUSTOMER_CONTACT')
      commit('CLEAR_CUSTOMER_CONTACT')
    },
    cancelClearContact(commit) {
      commit('CLEAR_CUSTOMER_CONTACT')
    },
    async insertCustomerData({ commit, state, dispatch }) {
      try {
        const result = await state.refs.simpleRules.validate()
        if (result) {
          if (state.add.setting_basic_branch_id !== undefined && state.add.setting_master_customer_id !== undefined) {
            state.add.setting_basic_branch_id = state.add.selected.id
            state.self.$swal({
              title: 'เพิ่มข้อมูลสมาชิก',
              text: `คุณต้องการเพิ่มข้อมูลสมาชิก ${state.add.customer_name} ใช่หรือไม่?`,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1',
              },
              buttonsStyling: false,
            }).then(async result => {
              if (result.value) {
                const resp = await state.api.post(
                  '/api/customers', state.add,
                )
                await commit('SET_MODEL_ID', resp.data.data.id)
                await state.refs.test_attached.submit()
                state.self.$swal({
                  icon: 'success',
                  title: 'เพิ่มข้อมูลสมาชิกสำเร็จ!',
                  text: `ข้อมูลสมาชิก ${state.add.customer_name} ถูกเพิ่มสำเร็จ`,
                  confirmButtonText: 'ยืนยัน',
                  cancelButtonText: 'ยกเลิก',
                  customClass: {
                    confirmButton: 'btn btn-success',
                  },
                }).then(result => {
                  if (result.value) {
                    commit('CLEAR_ADD_CUSTOMER_FORM')
                    router.push({ name: 'customerIndex', query: {} })
                  }
                })
              }
            })
          } else {
            state.self.$swal({
              title: 'ผิดพลาด!',
              text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
              icon: 'error',
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-danger',
              },
              buttonsStyling: false,
            })
          }
        } else {
          state.self.$swal({
            title: 'ผิดพลาด!',
            text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
            icon: 'error',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-danger',
            },
            buttonsStyling: false,
          })
        }
      } catch (error) {
        console.log('err', error)
      }
    },
    typeContext({ commit }, node) {
      commit('SET_TYPE_CONTACT', node)
    },
    async queryCustomerData({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/customers',
        )
        commit('SET_CUSTOMER_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
  },
}
