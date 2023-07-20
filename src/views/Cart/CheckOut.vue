<template>
    <main>
        <div class="back_button">
            <router-link to="/online-mall">
                <i class="fa fa-angle-left" aria-hidden="true"></i> 返回購物車
            </router-link>
        </div>
        <div class="container checkPage">
            <h4>運送方式</h4>
            <form action="">
                <div>
                    <input type="radio" id="delivery-home" name="delivery" value="H">
                    <label for="delivery-home">【宅配】</label>
                </div>
                <div>
                    <input type="radio" id="delivery-inStore" name="delivery" value="C">
                    <label for="delivery-inStore">【車站取貨】</label>
                </div>
            </form>
            <hr>
            <div class="recipient">
                <div class="recipientInfo">
                    <div class="recipientName">麥 大明</div>
                    <div class="recipientPhone">+886 912345678</div>
                </div>
                <div class="address">
                    <div class="title">recipientAddress</div>
                    <div class="recipientAddress">桃園市中壢區</div>
                </div>
            </div>
            <hr>
            <h4>付款方式</h4>
            <form action="">
                <div>
                    <input type="radio" id="creditCard" name="pay" value="">
                    <label for="creditCard">信用卡付款</label>
                </div>
                <div>
                    <input type="radio" id="cashOnDelivery" name="pay" value="">
                    <label for="cashOnDelivery">取貨付款</label>
                </div>
            </form>
            <div class="orderDetails">
                <div class="orderItem" v-if="productData.length > 0">
                    <div class="orderPic">
                        <img :src="productData[0].image" alt="">
                    </div>
                    <div class="orderInfo">
                        <div>{{ productData[0].title }}</div>
                        <div class="item-price">{{ productData[0].price }}</div>
                    </div>
                    <div class="orderPrice">
                        x3
                    </div>
                </div>
            </div>
            <hr class="hrBot">
            <div class="totalPrice item-price">
                總計:
                <span class="h3">123</span>
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