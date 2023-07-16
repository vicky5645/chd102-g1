import { createStore } from 'vuex'

export default createStore({
  state: {
    name: '登入/註冊',
  },
  getters: {
  },
  mutations: {
    setName (state, payload) {
      state.name = payload
    },
  },
  actions: {
  },
  modules: {
  }
})
