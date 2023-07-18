import { createStore } from 'vuex'

export default createStore({
  state: {
    name: 'hi',
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