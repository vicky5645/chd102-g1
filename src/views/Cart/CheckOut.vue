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
                    <h4>運送方式</h4>
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
                            <div class="recipientName">麥 大明</div>
                            <div class="recipientPhone">+886 912345678</div>
                        </div>
                        <div class="address">
                            <div class="title">收件人地址：</div>
                            <div class="recipientAddress">320桃園市中壢區復興路46號9樓</div>
                        </div>
                    </div>
                    <h4>付款方式</h4>
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
                    <div class="orderList" @click="isShow = !isShow">
                        <h4>商品訂單明細</h4>
                        <i class="fa-solid fa-angle-right" :style="{ transform: isShow ? 'rotate(90deg)' : 'rotate(0deg)' }"></i>
                    </div>
                    <div class="orderDetails" v-if="productData.length > 0" v-show="isShow">
                        <div class="orderItem">
                            <div class="orderPic">
                                <Images :imgURL="`${productData[0].image}`" :alt="``" />
                                <!-- <img :src="productData[0].image" alt=""> -->
                            </div>
                            <div class="orderInfo">
                                <div>{{ productData[0].title }}</div>
                                <div class="item-price">{{ productData[0].price }}</div>
                                <div class="orderPrice">
                                    數量 <span class="qty">3</span>
                                </div>
                            </div>
                        </div>
                        <div class="orderItem">
                            <div class="orderPic">
                                <Images :imgURL="`${productData[0].image}`" :alt="``" />
                                <!-- <img :src="productData[0].image" alt=""> -->
                            </div>
                            <div class="orderInfo">
                                <div>{{ productData[0].title }}</div>
                                <div class="item-price">{{ productData[0].price }}</div>
                                <div class="orderPrice">
                                    數量 <span class="qty">3</span>
                                </div>
                            </div>
                        </div>
                        <div class="orderItem">
                            <div class="orderPic">
                                <Images :imgURL="`${productData[0].image}`" :alt="``" />
                                <!-- <img :src="productData[0].image" alt=""> -->
                            </div>
                            <div class="orderInfo">
                                <div>{{ productData[0].title }}</div>
                                <div class="item-price">{{ productData[0].price }}</div>
                                <div class="orderPrice">
                                    數量 <span class="qty">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hrBot">
                    <div class="totalPrice item-price">
                        總計:
                        <span class="h3">123</span>
                    </div>
                </div>
            </div>
            <div class="checkOut">
                <button class="btn-checkOut">前往結帳</button>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            isShow: true,
            productData: [],
        }
    },
    created() {
        // 取得API
        fetch('/data/productData.json')
            .then(res => res.json())
            .then(json => {
                this.productData = json
            })
    },
    methods: {
    }
}
</script>