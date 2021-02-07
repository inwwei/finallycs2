const master = () => ({
  api: '',
  self: '',
  modal: '',
  refs: '',
  pageLength: 5,
  branch_column: [
    {
      label: 'รหัสสาขา',
      field: 'branch_code',
    },
    {
      label: 'ชื่อสาขา',
      field: 'branch_name',
    },
    {
      label: 'บริษัท',
      field: 'setting_basic_company.name',
    },
    {
      label: 'ที่อยู่',
      field: 'setting_basic_company.title',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  branch: [],
  get_branch: '',
  setting_basic_company: [],
  edit: {
    branch_code: '',
    branch_name: '',
    setting_basic_company: {},
    setting_basic_company_id: '',
  },
  add: {
    branch_code: '',
    branch_name: '',
    setting_basic_company: {},
    setting_basic_company_id: '',
  },
})
export default {
  namespaced: true,
  state: master(),
  getters: {},
  mutations: {
    // SET VALUE
    SET_BRANCH_DATA(state, data) {
      state.branch = data
    },
    SET_COMPANY_DATA(state, data) {
      state.setting_basic_company = data
    },
    SET_API(state, { api, self }) {
      state.api = api
      state.self = self
    },
    SET_REFS(state, refs) {
      state.refs = refs
    },
    SET_MODAL(state, modal) {
      state.modal = modal
    },
    GET_DATA_IN_TABLE(state, data) {
      state.modal.show('modal-edit-branch')
      state.edit = data
    },
    OPEN_ADD_MODAL(state) {
      state.modal.show('modal-add-branch')
    },
    CLEAR_ADD_BRANCH_MODAL(state) {
      state.add = master().add
    },
  },
  actions: {
    //   Set value
    setModal({ commit }, modal) {
      commit('SET_MODAL', modal)
    },
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    setRefs({ commit }, refs) {
      commit('SET_REFS', refs)
    },
    openAddBranchModal({ commit }) {
      commit('OPEN_ADD_MODAL')
    },
    // ACTION
    async updateBranch({ commit, state, dispatch }) {
      try {
        state.self.$swal({
          title: 'แก้ไขข้อมูลสาขา',
          text: `คุณต้องการแก้ไขข้อมูลสาขา ${state.edit.branch_name} ใช่หรือไม่?`,
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
              `/api/setting/basic/branch/${state.edit.id}`, state.edit,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขข้อมูลสาขาสำเร็จ!',
              text: `แก้ไขข้อมูลสาขา ${state.edit.branch_name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadBranchData')
              }
            })
          }
        })
      } catch (error) {
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
    },
    async addBranch({ commit, state, dispatch }) {
      state.add.company_id = state.add.setting_basic_company.id
      try {
        state.self.$swal({
          title: 'เพิ่มตั้งค่าสาขา',
          text: `คุณต้องการเพิ่มตั้งค่าสาขา ${state.add.branch_name} ใช่หรือไม่?`,
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
            state.api.post(
              '/api/setting/basic/branch', state.add,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขตั้งค่าสาขาสำเร็จ!',
              text: `แก้ไขตั้งค่าสาขา ${state.add.branch_name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                commit('CLEAR_ADD_BRANCH_MODAL')
                dispatch('loadBranchData')
              }
            })
          }
        })
      } catch (error) {
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
    },
    async deleteBranch({ commit, state, dispatch }, data) {
      try {
        state.self.$swal({
          title: 'ลบตั้งค่าสาขา',
          text: `คุณต้องการลบตั้งค่าสาขา ${data.branch_name} ใช่หรือไม่?`,
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
              `/api/setting/basic/branch/${data.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ลบตั้งค่าสาขาสำเร็จ!',
              text: `ลบตั้งค่าสาขา ${data.branch_name} ถูกลบสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadBranchData')
              }
            })
          }
        })
      } catch (error) {
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
    },
    //   Load Data
    async loadCompany({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/setting/basic/company',
        )
        commit('SET_COMPANY_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async loadBranchData({ commit, state }) {
      try {
        const { data } = await state.api.get('/api/setting/basic/branch')
        commit('SET_BRANCH_DATA', data.data)
      } catch (error) {
        throw error
      }
    },
    async editBranch({ commit, state }, id) {
      try {
        const { data } = await state.api.get(
          `/api/setting/basic/branch/${id}`,
        )
        commit('GET_DATA_IN_TABLE', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
