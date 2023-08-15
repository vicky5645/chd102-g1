<template>
    <div class="cartPage cartFloat" v-show="cartStatus">
        <div class="closeMark" @click="closeCart">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h2>購物車</h2>
        <hr class="hrTop">
        <CartList/>
        <div class="checkOut">
                <button class="btn-checkOut default-btn" @click="goShoppingMall" v-if="cartEmpty">前往商城</button>
                <button class="btn-checkOut default-btn" @click="goCartInfo" v-else>確認清單</button>
        </div>
    </div>
    <div class="pageMask" v-show="cartStatus" @click="closeCart"></div>
</template>


<script>
import CartList from "@/components/CartList.vue";
// import { ref, useComputed, onMounted, defineProps, defineEmits } from 'vue';
// import { useStore, mapGetters } from 'vuex';
// import { useRouter } from 'vue-router';

export default {
    components: {
    CartList
  },
    props: ['cartStatus'],
    emits: ['closeCart', 'goCartInfo', 'goShoppingMall'],
    computed: {
        cartEmpty () {
            return this.$store.state.cart <= 0;
        }
    },
    methods: {
    // 關閉視窗按鈕
        closeCart() {
            this.$emit('closeCart')
    },
    // 前往購物車清單
        goCartInfo() {
            this.$emit('goCartInfo')
    },
    //前往商城
        goShoppingMall() {
            this.$emit('goShoppingMall')
        }

    }
}
</script>
<style lang="scss" scoped>
.pageMask {
    background-color: transparent;
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9;
}
</style>