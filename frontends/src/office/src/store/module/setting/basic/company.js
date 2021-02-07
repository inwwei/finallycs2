const master = () => ({
  api: '',
  self: '',
  modal: '',
  refs: '',
  pageLength: 5,
  company_column: [
    {
      label: 'ชื่อบริษัท',
      field: 'name',
    },
    {
      label: 'เลขผู้เสียภาษี',
      field: 'tex_id',
    },
    {
      label: 'เบอร์โทรติดต่อ',
      field: 'tel',
    },
    {
      label: 'ที่อยู่',
      field: 'title',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  company_data: [],
  branch: [],
  get_branch: '',
  edit: {
    id: '',
    name: '',
    tex_id: '',
    tel: '',
    title: '',
  },
  add: {
    id: '',
    name: '',
    tex_id: '',
    tel: '',
    title: '',
  },
})
export default {
  namespaced: true,
  state: master(),
  getters: {},
  mutations: {
    // SET VALUE
    SET_COMPANY_DATA(state, data) {
      state.company_data = data
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
      state.modal.show('modal-edit-company')
      state.edit = data
    },
    OPEN_ADD_MODAL(state) {
      state.modal.show('modal-add-company')
    },
    CLEAR_ADD_COMPANY_MODAL(state) {
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
    openAddCompanyModal({ commit }) {
      commit('OPEN_ADD_MODAL')
    },
    // ACTION
    async updateCompany({ commit, state, dispatch }) {
      try {
        state.self.$swal({
          title: 'แก้ไขข้อมูลบริษัท',
          text: `คุณต้องการแก้ไขข้อมูลบริษัท ${state.edit.name} ใช่หรือไม่?`,
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
              `/api/setting/basic/company/${state.edit.id}`, state.edit,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขข้อมูลบริษัทสำเร็จ!',
              text: `แก้ไขข้อมูลบริษัท ${state.edit.name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadCompany')
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
    async addCompany({ commit, state, dispatch }) {
      try {
        state.self.$swal({
          title: 'เพิ่มตั้งค่าบริษัท',
          text: `คุณต้องการเพิ่มตั้งค่าบริษัท ${state.add.name} ใช่หรือไม่?`,
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
              '/api/setting/basic/company', state.add,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขตั้งค่าบริษัทสำเร็จ!',
              text: `แก้ไขตั้งค่าบริษัท ${state.add.name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                commit('CLEAR_ADD_COMPANY_MODAL')
                dispatch('loadCompany')
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
    async deleteCompany({ commit, state, dispatch }, data) {
      try {
        state.self.$swal({
          title: 'ลบตั้งค่าบริษัท',
          text: `คุณต้องการลบตั้งค่าบริษัท ${data.name} ใช่หรือไม่?`,
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
              `/api/setting/basic/company/${data.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ลบตั้งค่าบริษัทสำเร็จ!',
              text: `ลบตั้งค่าบริษัท ${data.name} ถูกลบสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadCompany')
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
    async editCompany({ commit, state }, id) {
      try {
        const { data } = await state.api.get(
          `/api/setting/basic/company/${id}`,
        )
        commit('GET_DATA_IN_TABLE', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
