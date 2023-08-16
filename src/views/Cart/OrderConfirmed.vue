<template>
    <section class="order-confirmed">
        <div class="icon-wrap showing">
            <svg class="icon" viewBox="0 0 100 100" width="80" height="80">
                <circle class="circle" cx="50" cy="50" r="48"></circle>
                <polyline class="check" points="28,53 42,66 74,34"></polyline>
            </svg>
            <p class="catchy">您的訂單已送出</p>
            <div class="previousMsg" v-if="routeFrom">
                <p>感謝您的訂購</p>
                <p>來繪製自己的車票吧！</p>
            </div>
            <div class="previousMsg" v-else>
                <p>感謝您的購買</p>
                <p>請至會員中心確認您的訂單，並留意配送狀態</p>
            </div>
            <div class="btn-group">
                <bottom class="default-btn" @click="goPattern" v-if="routeFrom"> 客製車票 </bottom>
                <bottom class="default-btn" @click="goUserOrder" v-else> 會員中心 </bottom>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            routeFrom: false,
        }
    },
    //判斷來自哪個路由
    beforeRouteEnter(to,from,next) {
        console.log(to ,from)
        next(vm => vm.getRouteFrom(from.name))
    },
    methods: {
        //根據路由來源來切換routeFrom
        getRouteFrom(from) {
            console.log(from)
            console.log(from === 'paymentForBooking')
            if (from === 'paymentForBooking') {
                this.routeFrom = true;
            }
        },
        goUserOrder() {
            this.$router.push('user/order');
        },
        goPattern() {
            this.$router.push('/custom-tickets');
        },
    },
}
</script>
<style lang="scss" scoped>


</style>