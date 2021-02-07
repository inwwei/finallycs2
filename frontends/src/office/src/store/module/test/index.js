export default {
  namespaced: true,
  state: {
    test: 1,
    test1: '',
  },
  getters: {},
  mutations: {
    TEST(state, data) {
      state.test1 = data
      state.test += 1
    },
  },
  actions: {
    test1({ commit }, data) {
      commit('TEST', data)
    },
  },
}
