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
                            <input type="radio" id="delivery-home" name="delivery" value="" checked>
                            <label for="delivery-home">【宅配】</label>
                        </div>
                        <div>
                            <input type="radio" id="delivery-inStore" name="delivery" value="">
                            <label for="delivery-inStore">【車站取貨】</label>
                        </div>
                    </form>
                    <div class="recipient">
                        <div class="recipientInfo">
                            <h4 class="title">收件人</h4>
                            <input id="recipientName" class="typeStyle" type="text" value="麥大明">
                            <h4 class="title">連絡電話</h4>
                            <input id="recipientPhone" class="typeStyle" type="text" value="0912345678">
                            <h4 class="title">收件人地址：</h4>
                            <input id="recipientAddress" class="typeStyle" type="text" value="320桃園市中壢區復興路46號9樓">
                        </div>
                        <input id="sameWithUser" type="checkbox"> <label for="sameWithUser">同會員資料</label>
                    </div>
                    <h4 class="title">付款方式</h4>
                    <form action="">
                        <div>
                            <input type="radio" id="creditCard" name="pay" value="" checked>
                            <label for="creditCard">信用卡付款</label>
                        </div>
                        <div>
                            <input type="radio" id="cashOnDelivery" name="pay" value="">
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
                <button class="btn-checkOut" @click="goPayment">前往結帳</button>
            </div>
        </div>
    </main>
</template>
<script>
import CheckOutList from "@/components/CheckOutList.vue";
import { mapGetters } from 'vuex';
export default {
    data() {
        return {
            isShow: true,
            productData: [],
            showCheckList: true,
        }
    },
    components: {
        CheckOutList
    },
    computed: {
    ...mapGetters(['totalPrice']),
    },
    created() {
        // 取得API
        fetch('/data/productData.json')
            .then(res => res.json())
            .then(json => {
                this.productData = json
            })
    },
    created() {
        this.$store.commit("calculateSum");
    },
    methods: {
        toggleCheckList() {
        this.showCheckList = !this.showCheckList; // 點擊時切換顯示和隱藏的狀態
    },
        goPayment() {
            // alert("即將跳轉信用卡付款頁面！");
            this.$router.push('/payment');
        }
    }
}
</script>