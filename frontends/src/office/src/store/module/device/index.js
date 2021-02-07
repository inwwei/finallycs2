const data = () => ({
  api: '',
  notify: '',
  add: {
    name: '',
    pin: '',
  },
  edit: {
    name: '',
    pin: '',
  },
  device: [],
  activePrompt1: false,
  activePrompt2: false,
})
export default {
  namespaced: true,
  state: data(),
  getters: {},
  mutations: {
    setApi(state, api) {
      state.api = api
    },
    setNotify(state, notify) {
      state.notify = notify
    },
    setData(state, data) {
      state.device = data
    },
    showData(state, data) {
      state.edit = data
    },
    openPromt1(state) {
      state.activePrompt1 = true
    },
    closePromt1(state) {
      state.activePrompt1 = false
    },
    openPromt2(state) {
      state.activePrompt2 = true
    },
    closePromt2(state) {
      state.activePrompt2 = false
    },
    clearform(state) {
      state.add = data()
    },
  },
  actions: {
    setApi({ commit }, api) {
      commit('setApi', api)
    },
    setNotify({ commit }, notify) {
      commit('setNotify', notify)
    },
    async queryData({ commit, state }) {
      try {
        const { data } = await state.api.get('/api/setting/device')
        commit('setData', data.data)
      } catch (error) {
        throw error
      }
    },
    async addData({ state, dispatch, commit }) {
      await state.api.post(
        '/api/setting/device', state.add,
      )
      state.notify.notify({
        color: 'success',
        title: 'เพิ่มข้อมูล',
        text: 'เพิ่มข้อมูลอุปกรณ์สำเร็จ',
      })
      commit('closePromt1')
      commit('clearform')
      dispatch('queryData')
    },
    async editData({ commit, state }, id) {
      const { data } = await state.api.get(
        `/api/setting/device/${id}`,
      )
      commit('openPromt2')
      commit('showData', data.data)
    },
    async editDeviceData({ commit, dispatch, state }) {
      await state.api.put(
        `/api/setting/device/${state.edit.id}`,
        state.edit,
      )
      await state.notify.notify({
        color: 'success',
        title: 'ยืนยันการแก้ไขข้อมูล',
        text: 'แก้ไขข้อมูลอุปกรณ์สำเร็จ',
      })
      dispatch('queryData')
      commit('closePromt2')
    },
    async confirmDeleteData({ state, dispatch }, payload) {
      const { id } = payload

      const deleteData = async () => {
        await state.api.delete(
          `/api/setting/device/${id}`,
        )
        await state.notify.notify({
          color: 'danger',
          title: 'ลบข้อมูล',
          text: 'ลบข้อมูลอุปกรณ์สำเร็จ',
        })
        dispatch('queryData')
      }
      state.notify.dialog({
        type: 'confirm',
        color: 'danger',
        title: 'คุณต้องการลบข้อมูลใช่หรือไม่',
        accept: deleteData,
        acceptText: 'ยืนยัน',
        cancelText: 'ยกเลิก',
      })
      return ''
    },
    openPromt1({ commit }) {
      commit('openPromt1')
    },
    closePromt1({ commit }) {
      commit('closePromt1')
    },
    openPromt2({ commit }) {
      commit('openPromt2')
    },
    closePromt2({ commit }) {
      commit('closePromt2')
    },
  },
}
