import { createStore } from 'vuex'
const updateStorage = (cart) => {
  localStorage.setItem('my-cart', JSON.stringify(cart))
}
import axios from 'axios'
export default createStore({

  state: {
    name: '登入/註冊',
    cart: [],
    isLogin: false,
    totalPrice: 0,

    //景點
    attraction: {
      attr_id: 1,
      attr_name: ''
    },

    
    // 論壇資料
    AnnouncementData: [],
  },
  getters: {
    cartList(state) {
      return state.cart;
    },
    totalPrice(state) {
      return state.totalPrice;
    }
  },
  mutations: {
    setAnnouncementData(state,payload) {
      state.AnnouncementData = [...payload];
    },
    //傳景點id給元件
    throw_attr_id(state, parent_attr_id) {
      state.attraction.attr_id = parent_attr_id
    },
    setName(state, payload) {
      state.name = payload
    },
    updateCart(state, newData) {
      state.cart = [...newData];
    },
    // addToCart(state,item){
    //   state.cart.push(item);
    // },
    // calculateSum(state) {
    //   state.totalPrice = state.cart.reduce((accumulator, item) => {
    //       return accumulator + item.totalPrice;
    //     }, 0);
    // },
    //從商品頁面新增商品到購物車
    addToCart(state, newData) {
      let item = state.cart.find((i) => i.title === newData.title);

      if (item) {
        item.amount = parseInt(item.amount) + parseInt(newData.amount);
        item.totalPrice = parseInt(item.totalPrice) + (parseInt(newData.price) * parseInt(newData.amount));
      } else {
        newData.totalPrice = (parseInt(newData.price) * parseInt(newData.amount))
        state.cart.push({ ...newData });
      }

      updateStorage(state.cart);
    },
    //在購物車頁面增加數量
    addAmount(state, title) {
      let item = state.cart.find((i) => i.title === title);
      if (item) {
        item.amount = parseInt(item.amount) + 1;
        // item.price = (parseInt(item.price) / (item.amount - 1)) * item.amount;
        item.totalPrice += parseInt(item.price);
      }
      //更新總價
      state.totalPrice = state.cart.reduce((accumulator, item) => {
        return accumulator + item.totalPrice;
      }, 0);
      //更新購物車
      updateStorage(state.cart);
    },

    //在購物車頁面減少數量
    minusAmount(state, title) {
      let item = state.cart.find((i) => i.title === title);
      if (item && parseInt(item.amount) > 1) {
        item.amount = parseInt(item.amount) - 1;
        // item.price = (parseInt(item.price) / (item.amount + 1)) * item.amount;
        item.totalPrice -= parseInt(item.price);
      }
      //更新總價
      state.totalPrice = state.cart.reduce((accumulator, item) => {
        return accumulator + item.totalPrice;
      }, 0);
      //更新購物車
      updateStorage(state.cart);
    },

    //在購物車頁面刪除商品
    removeFromCart(state, title) {
      state.cart = state.cart.filter((i) => i.title !== title);
      //更新總價
      state.totalPrice = state.cart.reduce((accumulator, item) => {
        return accumulator + item.totalPrice;
      }, 0);
      //更新購物車
      updateStorage(state.cart);
    },
    setIsLogin(state, value) {
      state.isLogin = value;
    },
    calculateSum(state) {
      state.totalPrice = state.cart.reduce((accumulator, item) => {
        return accumulator + item.totalPrice;
      }, 0);
    },
  },
  actions: {
    async getAnnouncementData(context, value) {
      try {
        const res = await axios.get("http://localhost/phps/selectBackendAnnouncements.php");
        if (!res) throw new Error("沒抓到資料");
        context.commit('setAnnouncementData', res.data);
      } catch (err) {
        console.error(err);
      }
    },
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