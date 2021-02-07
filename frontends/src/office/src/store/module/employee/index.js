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
  employee_info_position: '',
  employee_info_branch: '',
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
    SET_USER_DATA(state, data) {
      state.users = data
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
    SET_ADD_DATA(state, add_employee) {
      state.add_employee.branch_id = add_employee.branch_selected.id
    },
    SET_EDIT_DATA(state, employee_info) {
      state.employee_info.branch_id = employee_info.setting_basic_branch.id
    },
    SET_TEMP_CONTACT_DATA(state) {
      state.add_employee.user_contacts.push({ ...state.tempContact })
    },
    DELETE_TEMP_CONTACT(state, id) {
      state.add_employee.user_contacts.splice(id, 1)
    },
    SET_TEMP_CONTACT_NULL(state) {
      state.tempContact = data().tempContact
    },
    SET_TYPE_CONTACT(state, node) {
      state.tempContact.type = node.name_th
    },
    SET_EMPLOYEE_INFO_DATA(state, data) {
      state.employee_info = data
      state.employee_info_position = data.setting_master_user.title
      state.employee_info_branch = data.setting_basic_branch.branch_name
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
    SET_MODEL_ID(state, id) {
      state.dataModelId = id
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
    async queryUserData({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/user',
        )
        commit('SET_USER_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async loadBranch({ commit, state }) {
      try {
        const { data } = await state.api.get('/api/setting/basic/branch')
        commit('SET_BRANCH', data.data)
      } catch (error) {
        throw error
      }
    },
    setEmployeeData({ commit, dispatch }, add_employee) {
      commit('SET_ADD_DATA', add_employee)
      dispatch('addEmployee')
    },
    setEditData({ commit, dispatch }, employee_info) {
      commit('SET_EDIT_DATA', employee_info)
      dispatch('editEmployeeData')
    },
    async addTempContact({ commit, dispatch }) {
      try {
        commit('SET_TEMP_CONTACT_DATA')
        dispatch('clearTempContact')
      } catch (error) {
        throw error
      }
    },
    async deleteTempContact({ commit }, id) {
      try {
        commit('DELETE_TEMP_CONTACT', id)
      } catch (error) {
        throw error
      }
    },
    async addEmployee({ state, commit }) {
      try {
        const result = await state.refs.simpleRules.validate()
        if (result) {
          if (state.add_employee.setting_master_users_id !== '' && state.add_employee.branch_id !== undefined) {
            state.self.$swal({
              title: 'เพิ่มข้อมูลพนักงาน',
              text: `คุณต้องการเพิ่มข้อมูลพนักงาน ${state.add_employee.name} ใช่หรือไม่?`,
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
              if (result.isConfirmed) {
                const resp = await state.api.post('/api/user', state.add_employee)
                await commit('SET_MODEL_ID', resp.data.data.id)
                await state.refs.test_attached.submit()
                state.self.$swal({
                  icon: 'success',
                  title: 'เพิ่มข้อมูลพนักงานสำเร็จ!',
                  text: `ข้อมูลพนักงาน ${state.add_employee.name} ถูกเพิ่มสำเร็จ`,
                  confirmButtonText: 'ยืนยัน',
                  customClass: {
                    confirmButton: 'btn btn-success',
                  },
                }).then(result => {
                  if (result.isConfirmed) {
                    commit('SET_USER_DATA_NULL')
                    router.push({ name: 'employeeIndex', query: {} })
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
        throw error
      }
    },
    // async editEmployeeData({ state, commit }) {
    //   try {
    //     if (state.employee_info.setting_master_users_id !== '' && state.employee_info.branch_id !== undefined) {
    //       state.self.$swal({
    //         title: 'แก้ไขข้อมูลพนักงาน',
    //         text: `คุณต้องการแก้ไขข้อมูลพนักงาน ${state.add_employee.name} ใช่หรือไม่?`,
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'ยืนยัน',
    //         cancelButtonText: 'ยกเลิก',
    //         customClass: {
    //           confirmButton: 'btn btn-primary',
    //           cancelButton: 'btn btn-outline-danger ml-1',
    //         },
    //         buttonsStyling: false,
    //       }).then(async result => {
    //         if (result.isConfirmed) {
    //           const resp = await state.api.put(`/api/user/${state.employee_info.id}`, state.employee_info)
    //           await commit('SET_MODEL_ID', resp.data.data.id)
    //           await state.refs.edit_attached.submit()

    //           state.self.$swal({
    //             icon: 'success',
    //             title: 'แก้ไขข้อมูลพนักงานสำเร็จ!',
    //             text: `ข้อมูลพนักงาน ${state.add_employee.name} ถูกแก้ไขสำเร็จ`,
    //             confirmButtonText: 'ยืนยัน',
    //             customClass: {
    //               confirmButton: 'btn btn-success',
    //             },
    //           }).then(result => {
    //             if (result.isConfirmed) {
    //               commit('SET_USER_DATA_NULL')
    //               router.push({ name: 'employeeIndex', query: {} })
    //             }
    //           })
    //         }
    //       })
    //     } else {
    //       state.self.$swal({
    //         title: 'ผิดพลาด!',
    //         text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
    //         icon: 'error',
    //         confirmButtonText: 'ยืนยัน',
    //         cancelButtonText: 'ยกเลิก',
    //         customClass: {
    //           confirmButton: 'btn btn-danger',
    //         },
    //         buttonsStyling: false,
    //       })
    //     }
    //   } catch (error) {
    //     throw error
    //   }
    // },
    async deleteEmployee({ state, dispatch }, user) {
      try {
        state.self.$swal({
          title: 'ลบข้อมูลพนักงาน',
          text: `คุณต้องการลบข้อมูลพนักงาน ${user.name} ใช่หรือไม่?`,
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
              `/api/user/${user.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ลบข้อมูลพนักงานสำเร็จ!',
              text: 'ข้อมูลพนักงานถูกลบสำเร็จ',
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                dispatch('queryUserData')
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    async editEmployee({ state }, id) {
      try {
        router.push({ name: 'employeeEdit', query: { id } })
      } catch (error) {
        throw error
      }
    },
    async infoEmployee({ state }, id) {
      try {
        router.push({ name: 'employeeInfo', query: { id } })
      } catch (error) {
        throw error
      }
    },
    async queryEmployeeInfo({ state, commit }) {
      try {
        commit('SET_MODEL_ID', state.employee_id)
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
    clearTempContact({ commit }) {
      commit('SET_TEMP_CONTACT_NULL')
    },
    nodeSelect({ commit }, node) {
      commit('SET_NODE', node)
    },
    typeContact({ commit }, node) {
      commit('SET_TYPE_CONTACT', node)
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
