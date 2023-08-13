import { createStore } from 'vuex'
const updateStorage = (cart) => {
  localStorage.setItem('my-cart', JSON.stringify(cart))
}
//使用者資料傳到localStorage
const updateStorageLogin = (newUser) => {
  // 只能保存字串，這裡將JavaScript 處理成 JSON
  localStorage.setItem('my-user', JSON.stringify(newUser))
}
import axios from 'axios';
import { BASE_URL } from "@/assets/js/common.js";
export default createStore({
  state: {
    name: "",
    userInfo: null,
    // userInfo: {
    //   uid: existUser.uid, // 沒有存進資料庫
    //   mem_no: "",
    //   mem_name: "",
    //   mem_salutation: "",
    //   mem_email: "",
    //   mem_mobile: "",
    //   mem_addr: "",
    //   mem_acc: "",
    //   mem_pwd: "",
    //   pattern_file: "",
    // },
    isLogin: false,
    cart: [],
    totalPrice: 0,

    //景點
    attraction: {
      attr_id: 1,
      attr_name: "",
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
    },
    getUserInfo(state) {
      return state.userInfo;
    },
  },
  mutations: {
    setAnnouncementData(state, payload) {
      state.AnnouncementData = [...payload];
    },
    //傳景點id給元件
    throw_attr_id(state, parent_attr_id) {
      state.attraction.attr_id = parent_attr_id;
    },
    //設定登入狀態
    setIsLogin(state, value) {
      state.isLogin = value;
    },
    //更新使用者名稱
    setName(state, userName) {
      state.name = userName;
    },
    //更新使用者資料
    updateUser(state, newUser) {
      state.userInfo = newUser;
      //取得使用者資料的同時建立localStorage'my-user'
      updateStorageLogin(state.userInfo);
    },
    //刪除localStorage使用者資料
    deleteUser(state) {
      state.userInfo = null;
      localStorage.removeItem("my-user");
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
        item.totalPrice =
          parseInt(item.totalPrice) +
          parseInt(newData.price) * parseInt(newData.amount);
      } else {
        newData.totalPrice = parseInt(newData.price) * parseInt(newData.amount);
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
    calculateSum(state) {
      state.totalPrice = state.cart.reduce((accumulator, item) => {
        return accumulator + item.totalPrice;
      }, 0);
    },
  },
  actions: {
    async getAnnouncementData(context, value) {
      try {
        const res = await axios.get(`${BASE_URL}selectBackendAnnouncements.php`);
        if (!res) throw new Error("沒抓到資料");
        context.commit("setAnnouncementData", res.data);
      } catch (err) {
        console.error(err);
      }
    },
    // addCart({commit},item){
    //   commit("addCart",item)
    // },
    initStorage({ commit }) {
      const cart = localStorage.getItem("my-cart");
      if (!cart) return;
      commit("updateCart", JSON.parse(cart));
    },
    // initStorage() {
    //   const cart = localStorage.getItem('my-cart');
    //   if (!cart) return;
    //   commit("updateCart", JSON.parse(cart));
    // },
    //接受 commit 觸發 mutation
    initStorageLogin({ commit }) {
      //指定 localStorage 中 'my-user'的資料
      const user = localStorage.getItem("my-user");
      commit("setIsLogin", false);
      // 假如沒有建立'my-user'就結束操作
      if (!user) return;
      // 'my-user' 存在，執行updateUser()，JSON 字串解析成 JavaScript 物件
      commit("updateUser", JSON.parse(user));
      commit("setIsLogin", true);
    },
  },
  modules: {},
});