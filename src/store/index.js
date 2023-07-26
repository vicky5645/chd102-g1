import { createStore } from 'vuex'
const updateStorage = (cart) => {
  localStorage.setItem('my-cart', JSON.stringify(cart))
}


export default createStore({
  state: {
    name: '登入/註冊',
    cart:[],
    isLogin: false
  },
  getters: {
    cartList(state){
      return state.cart;
    }
  },
  mutations: {
    setName (state, payload) {
      state.name = payload
    },
    updateCart(state, newData) {
      state.cart = [...newData];
    },
    // addToCart(state,item){
    //   state.cart.push(item);
    // },
    addToCart(state, newData) {
      let item = state.cart.find((i) => i.title === newData.title);

      if (item) {
        item.amount = parseInt(item.amount) + parseInt(newData.amount);
        item.price = parseInt(item.price) + parseInt(newData.price);
      } else {
        state.cart.push({ ...newData });
      }

      updateStorage(state.cart);
    },
    addAmount(state, title) {
      let item = state.cart.find((i) => i.title === title);
      if (item) {
        item.amount = parseInt(item.amount) + 1;
        item.price = (parseInt(item.price) / (item.amount - 1)) * item.amount;
      }
      // storage.set("cart", state.cart);
      updateStorage(state.cart);
    },
    minusAmount(state, title) {
      let item = state.cart.find((i) => i.title === title);
      if (item && parseInt(item.amount) > 1) {
        item.amount = parseInt(item.amount) - 1;
        item.price = (parseInt(item.price) / (item.amount + 1)) * item.amount;
      }
      // storage.set("cart", state.cart);
      updateStorage(state.cart);
    },
    setIsLogin(state, value) {
      state.isLogin = value;
    },
  },
  actions: {
    // addCart({commit},item){
    //   commit("addCart",item)
    // },
    initStorage({ commit }) {
      const cart = localStorage.getItem('my-cart');
      if (!cart) return;
      commit("updateCart", JSON.parse(cart));
    },
    // initStorage() {
    //   const cart = localStorage.getItem('my-cart');
    //   if (!cart) return;
    //   commit("updateCart", JSON.parse(cart));
    // },
  },
  modules: {
  }
})