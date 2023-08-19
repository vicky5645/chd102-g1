<template>
    <main>
        <div class="back_button">
            <router-link to="/cart">
                <i class="fa fa-angle-left" aria-hidden="true"></i> 返回購物車
            </router-link>
        </div>
        <div class="container checkPage">
            <h2>訂購資訊</h2>
            <hr class="hrBot">
            <div class="wrap">
                <div class="selectInfo">
                    <h4 class="title">運送方式</h4>
                    <form action="">
                        <div>
                            <input type="radio" id="delivery-home" name="delivery" value="1" checked>
                            <label for="delivery-home">【宅配】</label>
                        </div>
                        <div>
                            <input type="radio" id="delivery-inStore" name="delivery" value="2">
                            <label for="delivery-inStore">【車站取貨】</label>
                        </div>
                    </form>
                    <div class="recipient">
                        <div class="recipientInfo">
                            <h4 class="title">收件人</h4>
                            <input id="recipientName" class="typeStyle" type="text" v-model="recipient.recipient">
                            <h4 class="title">連絡電話</h4>
                            <input id="recipientPhone" class="typeStyle" type="text" v-model="recipient.recipient_tele">
                            <h4 class="title">收件人地址：</h4>
                            <input id="recipientAddress" class="typeStyle" type="text" v-model="recipient.recipient_address">
                        </div>
                        <input id="sameWithUser" type="checkbox" @click="getUserInfo"> <label for="sameWithUser">同會員資料</label>
                    </div>
                    <h4 class="title">付款方式</h4>
                    <form action="">
                        <div>
                            <input type="radio" id="creditCard" name="pay" value="0" v-model="paymentMethod">
                            <label for="creditCard">信用卡付款</label>
                        </div>
                        <div>
                            <input type="radio" id="cashOnDelivery" name="pay" value="1" v-model="paymentMethod">
                            <label for="cashOnDelivery">取貨付款</label>
                        </div>
                    </form>
                </div>
                <div class="detailsInfo">
                    <div class="orderList" @click="toggleCheckList">
                        <h4>商品訂單明細</h4>
                        <i class="fa-solid fa-angle-right" :style="{ transform: showCheckList ? 'rotate(90deg)' : 'rotate(0deg)' }"></i>
                    </div>
                    <CheckOutList v-show="showCheckList"/>
                    <hr class="hrBot">
                    <div class="totalPrice item-price">
                        總計:
                        <span class="h3">{{ totalPrice }}</span>
                    </div>
                </div>
            </div>
            <div class="checkOut">
                <button class="btn-checkOut default-btn" @click="goPayment">前往結帳</button>
            </div>
        </div>
    </main>
</template>
<script>
import { BASE_URL } from "@/assets/js/common.js";
import axios from 'axios';
import CheckOutList from "@/components/CheckOutList.vue";
import { mapGetters } from 'vuex';
export default {
    data() {
        return {
            nowDate:"",
            isShow: true,
            // productData: [],
            showCheckList: true,
            recipient: {
                mem_no:"",
                order_total:"",
                order_status:0,
                recipient:"",
                recipient_tele:"",
                recipient_address:"",
                pay:"1",
                orderItems: [] // 存訂單項目
            },
            paymentMethod:"1",
        }
    },
    components: {
        CheckOutList
    },
    computed: {
    ...mapGetters(['totalPrice','cartList']),
    },
    created() {
        // 取得API
        // fetch('/data/productData.json')
        //     .then(res => res.json())
        //     .then(json => {
        //         this.productData = json
        //     })
    },
    created() {
        this.$store.commit("calculateSum");
        this.addCartItemsToOrder();
    },
    methods: {
        toggleCheckList() {
            this.showCheckList = !this.showCheckList; // 點擊時切換顯示和隱藏的狀態
        },
        getUserInfo(event) {
            if (event.target.checked) {
                this.recipient.recipient = this.$store.state.userInfo.mem_name; //會員名稱
                this.recipient.recipient_tele = this.$store.state.userInfo.mem_mobile; //會員電話
                this.recipient.recipient_address = this.$store.state.userInfo.mem_addr; //會員地址
            } else {
                this.mem_name = "";
                this.mem_mobile = "";
                this.mem_addr = "";
            }
        },
        // newDate() {
        //     const currentDate = new Date();
        //     const year = currentDate.getFullYear();
        //     const month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // 月份從 0 開始，需要加 1
        //     const day = currentDate.getDate().toString().padStart(2, '0');
        //     const formattedDate = `${year}-${month}-${day}`;
        //     this.nowDate = formattedDate;
        // },
        //送出訂單
        async postOrder() {
        this.$store.state.Loading = true;
        try {
          const res = await axios({
            method: 'post',
            url: `${BASE_URL}postProductOrder.php`,
            data: this.recipient
          });
          if (res.data.msg === "訂單成功送出") {
            this.$store.commit('clearCart');
          } else {
            alert("發生錯誤請稍後再嘗試");
            return;
          }
        //   alert(`${res.data.msg}`);
        } catch (error) {
            console.error("An error occurred:", error);
            // alert("發生錯誤請稍後再嘗試");
        }
        setTimeout(() => {
        this.$store.commit('closeLoading'),this.$router.push('/orderConfirmed')
      }, 300)
        },
        //打包
        packRecipient() {
            this.recipient.mem_no = parseInt(this.$store.state.userInfo.mem_no);
            this.recipient.order_total = parseInt(this.$store.state.totalPrice);
            this.recipient.pay = parseInt(this.paymentMethod);
            this.$store.commit('setRecipient',this.recipient);
        },
        // 取得對應的訂單項目
        addCartItemsToOrder() {
            const orderItems = this.cartList.map(item => {
                return {
                    prod_no: item.id,
                    price: item.price,
                    quantity: item.amount
                };
            });
            this.recipient.orderItems = orderItems;
        },
        goPayment() {
            // alert("即將跳轉信用卡付款頁面！");
            if (this.paymentMethod === '0') {
                this.packRecipient();
                this.$router.push('/payment');
            } else if (this.paymentMethod === '1') {
                this.packRecipient();
                this.postOrder();
            }
        }
    }
}
</script>