<template>
    <div class="cartPage cartFloat" v-show="cartStatus">
        <div class="closeMark" @click="closeCart">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h2>購物車</h2>
        <hr class="hrTop">
        <CartList/>
        <div class="checkOut">
                <button class="btn-checkOut" @click="goCartInfo">確認</button>
        </div>
    </div>
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
    emits: ['closeCart', 'goCartInfo'],

    methods: {
    // 關閉視窗按鈕
        closeCart() {
            this.$emit('closeCart')
    },
    // 前往購物車清單
        goCartInfo() {
            this.$emit('goCartInfo')
    }

    }
}
</script>
