import router from '@/router'

const master = () => ({
  api: '',
  modal: '',
  id: '',
  dataModelId: '',
  self: '',
  refs: '',
  show_modal: true,
  pageLength: 5,
  dataModelName: '\\App\\Models\\Customer',
  option: [],
  customer_contact: [],
  edit_customer_contact: {},
  edit_add_customer_contact: {},
  columns_customer_contact: [
    {
      label: 'ประเภทข้อมูลติดต่อ',
      field: 'setting_master_contact.name_th',
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
  edit: {},
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
    SET_REFS(state, refs) {
      state.refs = refs
    },
    SET_DATA_MODEL_ID(state, id) {
      state.dataModelId = id
    },
    SET_MODAL(state, modal) {
      state.modal = modal
    },
    SET_EDIT_CUSTOMER_ID(state, id) {
      state.id = id
    },
    SET_CUSTOMER_DATA(state, data) {
      state.edit = data
    },
    SET_CUSTOMER_CONTACT_DATA(state, data) {
      state.customer_contact = data
      //   state.customer_contact.full_value = `${state.customer_contact.value ?? ''}  ${state.customer_contact.house_number ?? ''} ${state.customer_contact.district ?? ''} ${state.customer_contact.amphure ?? ''} ${state.customer_contact.province ?? ''} ${state.customer_contact.postal_code ?? ''}`
    },
    SET_BRANCH_DATA(state, data) {
      state.option = data
    },
    SET_EDIT_CUSTOMER_CONTACT(state, data) {
      state.edit_customer_contact = data
      state.edit_customer_contact.contact_name_th = state.edit_customer_contact.setting_master_contact.name_th
      state.modal.show('modal-primary')
    },

    CLEAR_CUSTOMER_CONTACT(state, data) {
      state.edit_customer_contact = master().edit_customer_contact
    },
    CLEAR_ATTACHED_ID(state) {
      state.dataModelId = master().dataModelId
    },
    CLEAR_EDIT_FORM_ID(state) {
      state.edit = master().edit
    },
    CLEAR_ADD_CUSTOMER_CONTACT(state, data) {
      state.edit_add_customer_contact = master().edit_customer_contact
    },
    SET_TYPE_CONTACT(state, node) {
      state.customer_contact.type = node.name_th
    },
    SET_CUSTOMER_CONTACT(state, data) {
      console.log(state.edit_customer_contact, state.edit.id)
    },

  },
  actions: {
    setRefs({ commit }, refs) {
      commit('SET_REFS', refs)
    },
    setDataModelId({ commit }, id) {
      commit('SET_DATA_MODEL_ID', id)
    },
    clearEditForm({ commit }) {
      commit('CLEAR_ATTACHED_ID')
      commit('CLEAR_EDIT_FORM_ID')
    },
    backToIndex({ commit }) {
      commit('CLEAR_ATTACHED_ID')
      router.push({ name: 'customerIndex', query: { } })
    },
    async deleteContact({ dispatch, state }, data) {
      state.self.$swal({
        title: 'ลบข้อมูลสมาชิก',
        text: `คุณต้องการลบข้อมูลสมาชิก ${data.title} ใช่หรือไม่?`,
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
            `/api/customercontacts/${state.edit.id}/${data.id}`,
          )
          state.self.$swal({
            icon: 'success',
            title: 'ลบข้อมูลสมาชิกสำเร็จ',
            text: `ข้อมูลสมาชิก ${data.title} ถูกลบสำเร็จ`,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(result => {
            if (result.value) {
              dispatch('loadCustomerContact', state.edit.id)
            }
          })
        }
      })
    },
    async editCustomerData({ commit, state, dispatch }) {
      state.self.$swal({
        title: 'แก้ไขข้อมูลสมาชิก',
        text: `คุณต้องการแก้ไขข้อมูลสมาชิก ${state.edit.customer_name} ใช่หรือไม่?`,
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
          state.api.put(
            `/api/customers/${state.edit.id}`, state.edit,
          )
          state.self.$swal({
            icon: 'success',
            title: 'แก้ไขข้อมูลสมาชิกสำเร็จ',
            text: `ข้อมูลสมาชิก ${state.edit.customer_name} ถูกแก้ไขสำเร็จ`,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(result => {
            if (result.value) {
              state.refs.test_attached.submit()
              router.push({ name: 'customerIndex', query: { } })
            }
          })
        }
      })
    },
    async editContact({ commit, state, dispatch }) {
      state.edit_add_customer_contact.customer_id = state.edit.id
      state.api.put(
        `/api/customercontacts/${state.edit.id}/${state.edit_customer_contact.id}`, state.edit_customer_contact,
      )
      setTimeout(() => {
        dispatch('loadCustomerContact', state.edit.id)
      }, 400)
    },
    async insertCustomerContact({ commit, state, dispatch }) {
      state.edit_add_customer_contact.customer_id = state.edit.id
      state.api.post(
        `/api/customercontacts/${state.edit.id}`, state.edit_add_customer_contact,
      )
      setTimeout(() => {
        dispatch('loadCustomerContact', state.edit.id)
      }, 400)
    },
    cancelClearContact({ commit }) {
      commit('CLEAR_CUSTOMER_CONTACT')
    },
    editCustomer({ commit, dispatch }, id) {
      router.push({ name: 'customerEdit', query: { id } })
      commit('SET_EDIT_CUSTOMER_ID', id)
    //   dispatch('queryCustomerData', data.id)
    },
    // Set Data Api
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    setModal({ commit }, modal) {
      commit('SET_MODAL', modal)
    },
    editCustomerContact({ commit, dispatch }, id) {
      commit('SET_EDIT_CUSTOMER_CONTACT', id)
    },
    typeContext({ commit }, node) {
      commit('SET_TYPE_CONTACT', node)
    },
    // Load Data
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
      commit('CLEAR_ADD_CUSTOMER_CONTACT')
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
