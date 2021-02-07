const master = () => ({
  api: '',
  self: '',
  modal: '',
  refs: '',
  pageLength: 5,
  device_column: [
    {
      label: 'ชื่อ',
      field: 'name',
    },
    {
      label: 'pin',
      field: 'pin',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  device_data: [],
  edit: {
    name: '',
    pin: '',
  },
  add: {
    name: '',
    pin: '',
  },
})
export default {
  namespaced: true,
  state: master(),
  getters: {},
  mutations: {
    // SET VALUE
    SET_DEVICE_DATA(state, data) {
      state.device_data = data
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
      state.modal.show('modal-edit-device')
      state.edit = data
    },
    OPEN_ADD_MODAL(state) {
      state.modal.show('modal-add-device')
    },
    CLEAR_ADD_DEVICE_MODAL(state) {
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
    openAddDeviceModal({ commit }) {
      commit('OPEN_ADD_MODAL')
    },
    // ACTION
    async updateDevice({ commit, state, dispatch }) {
      try {
        state.self.$swal({
          title: 'แก้ไขข้อมูลการเข้าถึงระบบ',
          text: `คุณต้องการแก้ไขข้อมูลการเข้าถึงระบบ ${state.edit.name} ใช่หรือไม่?`,
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
              `/api/setting/device/${state.edit.id}`, state.edit,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขข้อมูลการเข้าถึงระบบสำเร็จ!',
              text: `แก้ไขข้อมูลการเข้าถึงระบบ ${state.edit.name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadDeviceData')
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
    async addDevice({ commit, state, dispatch }) {
      try {
        state.self.$swal({
          title: 'เพิ่มตั้งค่าการเข้าถึงระบบ',
          text: `คุณต้องการเพิ่มตั้งค่าการเข้าถึงระบบ ${state.add.name} ใช่หรือไม่?`,
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
              '/api/setting/device', state.add,
            )
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขตั้งค่าการเข้าถึงระบบสำเร็จ!',
              text: `แก้ไขตั้งค่าการเข้าถึงระบบ ${state.add.name} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                commit('CLEAR_ADD_DEVICE_MODAL')
                dispatch('loadDeviceData')
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
    async deleteDevice({ commit, state, dispatch }, data) {
      try {
        state.self.$swal({
          title: 'ลบตั้งค่าการเข้าถึงระบบ',
          text: `คุณต้องการลบตั้งค่าการเข้าถึงระบบ ${data.name} ใช่หรือไม่?`,
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
              `/api/setting/device/${data.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ลบตั้งค่าการเข้าถึงระบบสำเร็จ!',
              text: `ลบตั้งค่าการเข้าถึงระบบ ${data.name} ถูกลบสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('loadDeviceData')
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
    async loadDeviceData({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/setting/device',
        )
        commit('SET_DEVICE_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async editDevice({ commit, state }, id) {
      try {
        const { data } = await state.api.get(
          `/api/setting/device/${id}`,
        )
        commit('GET_DATA_IN_TABLE', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
