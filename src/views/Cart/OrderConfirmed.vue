<template>
    <section class="order-confirmed">
        <div class="icon-wrap showing">
            <svg class="icon" viewBox="0 0 100 100" width="80" height="80">
                <circle class="circle" cx="50" cy="50" r="48"></circle>
                <polyline class="check" points="28,53 42,66 74,34"></polyline>
            </svg>
            <p class="catchy">您的訂單已送出</p>
            <p>感謝您的購買</p>
            <p>請至會員中心確認您的訂單，並留意配送狀態</p>
            <bottom class="default-btn" @click="goUserOrder"> 會員中心 </bottom>
        </div>
    </section>
</template>
<script>
export default {
    methods: {
        goUserOrder() {
            this.$router.push('user/order');
        }
    }
}
</script>
<style lang="scss" scoped>


</style>