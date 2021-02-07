const master = () => ({
  api: '',
  self: '',
  modal: '',
  refs: '',
  pageLength: 5,
  generate_code_column: [
    {
      label: 'ชื่อ',
      field: 'name',
    },
    {
      label: 'รูปแบบ',
      field: 'pattern',
    },
    {
      label: 'โค้ด',
      field: 'code',
    },
    {
      label: 'สาขา',
      field: 'setting_basic_branch.branch_name',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  generate_code_data: [],
  branch: [],
  get_branch: '',
  edit: {
    id: '',
    pattern: '',
    code: '',
    branch: '',
    setting_basic_branch: {},
  },
  add: {
    id: '',
    pattern: 'CODE-BRANCHYYMMRRRR',
    code: '',
    branch: '',
    setting_basic_branch: {},
  },
})
export default {
  namespaced: true,
  state: master(),
  getters: {},
  mutations: {
    // SET VALUE
    SET_GENERATE_CODE_DATA(state, data) {
      state.generate_code_data = data
    },
    SET_BRANCH_DATA(state, data) {
      state.branch = data
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
    CHANGE_BRANCH(state, branch) {
      state.get_branch = branch
    },
    GET_DATA_IN_TABLE(state, data) {
      state.modal.show('modal-edit')
      state.edit = data
    },
    OPEN_ADD_MODAL(state) {
      state.modal.show('modal-add')
    },
    CLEAR_ADD_MODAL_CODE(state) {
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
    changeBranch({ commit }, branch) {
      commit('CHANGE_BRANCH', branch)
    },
    openAddModal({ commit }) {
      commit('OPEN_ADD_MODAL')
    },
    // ACTION
    async updateCode({ commit, state, dispatch }) {
      state.edit.setting_basic_branch_id = state.edit.setting_basic_branch.id
      try {
        state.self.$swal({
          title: 'แก้ไขรหัสคุม',
          text: `คุณต้องการแก้ไขรหัสคุม ${state.edit.name} ใช่หรือไม่?`,
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
              `/api/setting/generate/code/${state.edit.id}`, state.edit,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขรหัสคุมสำเร็จ!',
              text: `แก้ไขรหัสคุม ${state.edit.name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                commit('CLEAR_ADD_MODAL_CODE')
                dispatch('loadGenerateCode')
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
    async addCode({ commit, state, dispatch }) {
      state.add.setting_basic_branch_id = state.add.setting_basic_branch.id
      try {
        state.self.$swal({
          title: 'เพิ่มรหัสคุม',
          text: `คุณต้องการเพิ่มรหัสคุม ${state.add.name} ใช่หรือไม่?`,
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
              '/api/setting/generate/code', state.add,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขรหัสคุมสำเร็จ!',
              text: `แก้ไขรหัสคุม ${state.add.name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadGenerateCode')
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
    async deleteCode({ commit, state, dispatch }, data) {
      try {
        state.self.$swal({
          title: 'ลบรหัสคุม',
          text: `คุณต้องการลบรหัสคุม ${data.name} ใช่หรือไม่?`,
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
              `/api/setting/generate/code/${data.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ลบรหัสคุมสำเร็จ!',
              text: `ลบรหัสคุม ${data.name} ถูกลบสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadGenerateCode')
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
    async loadGenerateCode({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/setting/generate/code',
        )
        commit('SET_GENERATE_CODE_DATA', data.data)
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
    async editCode({ commit, state }, id) {
      try {
        const { data } = await state.api.get(
          `/api/setting/generate/code/${id}`,
        )
        commit('GET_DATA_IN_TABLE', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
