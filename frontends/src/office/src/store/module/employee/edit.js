import router from '@/router'

const data = () => ({
  api: '',
  self: '',
  refs: '',
  modal: '',
  pageLength: 5,
  employee_id: '',
  columns: [
    {
      label: 'ชื่อ',
      field: 'name',
    },
    {
      label: 'รหัสพนักงาน',
      field: 'code',
    },
    {
      label: 'ตำแหน่ง',
      field: 'setting_master_user.name_th',
    },
    {
      label: 'สาขา',
      field: 'setting_basic_branch.branch_name',
    },
    {
      label: 'วงเงิน',
      field: 'financial',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  columnContacts: [
    {
      label: 'ประเภท',
      field: 'type',
    },
    {
      label: 'รายละเอียด',
      field: 'value',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },

  ],
  infoContacts: [
    {
      label: 'ประเภท',
      field: 'type',
    },
    {
      label: 'รายละเอียด',
      field: 'value',
    },
  ],
  add_employee: {
    name: '',
    identification_number: '',
    setting_master_users_id: '',
    code: '',
    username: '',
    password: '',
    financial: '',
    branch_selected: '',
    branch_id: '',
    email: '',
    user_contacts: [],
  },
  edit_employee: {
    name: '',
    identification_number: '',
    setting_master_users_id: '',
    code: '',
    username: '',
    password: '',
    financial: '',
    branch_selected: '',
    branch_id: '',
    email: '',
  },
  edit_employee_contact: {},
  branches: [],
  users: [],
  tempContact: {},
  employee_info: [],
  employee_contact: [],
  add_contact: {},
  edit_contact: {
    setting_master_contact: '',
  },
  dataModelId: '',
  dataModelName: '\\App\\Models\\User',
})
export default {
  namespaced: true,
  state: data(),
  getters: {},
  mutations: {
    SET_API(state, {
      api, self,
    }) {
      state.api = api
      state.self = self
    },
    SET_REFS(state, refs) {
      state.refs = refs
    },
    SET_ID(state, id) {
      state.employee_id = id
    },
    SET_USER_DATA_NULL(state) {
      state.add_employee = data().add_employee
    },
    SET_ADD_CONTACT_NULL(state) {
      state.add_contact = data().add_contact
    },
    SET_BRANCH(state, data) {
      state.branches = data
    },
    SET_NODE(state, node) {
      state.add_employee.financial = node.default_financial
    },
    SET_EDIT_DATA(state, employee_info) {
      state.employee_info.branch_id = employee_info.setting_basic_branch.id
    },
    SET_EMPLOYEE_INFO_DATA(state, data) {
      state.employee_info = data
    },
    SET_EMPLOYEE_CONTACT(state, data) {
      state.employee_contact = data
    },
    SET_CONTACT_ID(state, contact) {
      state.edit_contact.type = contact.setting_master_contact.name_th
      state.edit_contact = contact
    },
    SHOW_MODAL(state) {
      state.modal.show('edit_modal')
    },
    SET_MODAL(state, modal) {
      state.modal = modal
    },
    SET_EDIT_MODEL_ID(state) {
      state.dataModelId = state.employee_info.id
    },
    CLEAR_EDIT_FORM(state) {
      state.employee_info = data().employee_info
      state.dataModelId = data().dataModelId
    },
  },
  actions: {
    setModal({ commit }, modal) {
      commit('SET_MODAL', modal)
    },
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    setRefs({ commit }, refs) {
      commit('SET_REFS', refs)
    },
    setId({ commit }, id) {
      commit('SET_ID', id)
    },
    async loadBranch({ commit, state }) {
      try {
        const { data } = await state.api.get('/api/setting/basic/branch')
        commit('SET_BRANCH', data.data)
      } catch (error) {
        throw error
      }
    },
    setEditData({ commit, dispatch }, employee_info) {
      commit('SET_EDIT_DATA', employee_info)
      dispatch('editEmployeeData')
    },
    async editEmployeeData({ state }) {
      state.self.$swal({
        title: 'แก้ไขข้อมูลสมาชิก',
        text: `คุณต้องการแก้ไขข้อมูลพนักงาน ${state.employee_info.name} ใช่หรือไม่?`,
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
          state.api.put(`/api/user/${state.employee_info.id}`, state.employee_info)
          state.self.$swal({
            icon: 'success',
            title: 'แก้ไขข้อมูลสมาชิกสำเร็จ',
            text: `ข้อมูลพนักงาน ${state.employee_info.name} ถูกแก้ไขสำเร็จ`,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(async result => {
            if (result.value) {
              await state.refs.employee_edit_attached.submit()
              router.push({ name: 'employeeIndex', query: { } })
            }
          })
        }
      })
    },
    async queryEmployeeInfo({ state, commit }) {
      try {
        const { data } = await state.api.get(
          `/api/user/${state.employee_id}`,
        )
        await commit('SET_EMPLOYEE_INFO_DATA', data.data)
      } catch (error) {
        throw error
      }
    },
    async loadEmployeeContact({ state, commit }) {
      try {
        const { data } = await state.api.get(`/api/usercontact/${state.employee_id}`)
        commit('SET_EMPLOYEE_CONTACT', data.data)
      } catch (error) {
        throw error
      }
    },
    nodeSelect({ commit }, node) {
      commit('SET_NODE', node)
    },
    async addContact({ state, dispatch, commit }) {
      try {
        state.add_contact.user_id = state.employee_id
        state.api.post(`/api/usercontact/${state.employee_id}`, state.add_contact)
        setTimeout(() => {
          dispatch('loadEmployeeContact')
        }, 200)
        commit('SET_ADD_CONTACT_NULL')
      } catch (error) {
        throw error
      }
    },
    async deleteContact({ state, dispatch }, contact) {
      try {
        state.self.$swal({
          title: 'ลบข้อมูลติดต่อ',
          text: 'ยืนยันการลบข้อมูล',
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
          if (result.isConfirmed) {
            state.api.delete(
              `/api/usercontact/${state.employee_id}/${contact.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ลบข้อมูลสำเร็จ!',
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                dispatch('loadEmployeeContact')
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    async editContact({ state, dispatch }) {
      try {
        state.self.$swal({
          title: 'แก้ไขข้อมูลติดต่อ',
          text: 'ยืนยันการแก้ไขข้อมูล',
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
          if (result.isConfirmed) {
            state.api.put(
              `/api/usercontact/${state.employee_id}/${state.edit_contact.id}`,
              state.edit_contact,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขข้อมูลสำเร็จ!',
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                dispatch('loadEmployeeContact')
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    setContactId({ dispatch, commit }, contact) {
      commit('SET_CONTACT_ID', contact)
      commit('SHOW_MODAL')
    },
    BackToIndex({ commit }) {
      commit('CLEAR_EDIT_FORM')
      router.push({ name: 'employeeIndex', query: {} })
    },
    clearEditForm({ commit }) {
      commit('CLEAR_EDIT_FORM')
    },
  },
}
