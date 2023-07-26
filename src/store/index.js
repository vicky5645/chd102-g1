import { createStore } from 'vuex'

export default createStore({
  state: {
    name: '登入/註冊',
    isLogin: false
  },
  getters: {
  },
  mutations: {
    setName (state, payload) {
      state.name = payload
    },
    setIsLogin(state, value) {
      state.isLogin = value;
    },
  },
  actions: {
  },
  modules: {
  }
})