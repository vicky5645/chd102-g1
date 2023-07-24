<template>
    <div class="container cartPage cartFloat" v-show="cartStatus">
        <div class="closeMark" @click="closeCart">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h2>購物車</h2>
        <hr class="hrTop">
        <div class="cartList">
            <div class="cart-card card-block" v-if="productData.length > 0">
                <div class="cart-cardPic-group">
                    <div class="drop">
                        <button class="item-drop">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                    <div class="item-pic">
                        <img :src="productData[0].image" alt="">
                    </div>
                </div>
                <div class="item-info">
                    <a class="item-name" href="#">
                        {{ productData[0].title }}
                    </a>
                    <div class="item-price">
                        <span>{{ productData[0].price }}</span>
                    </div>
                </div>
                <div class="btn-group">
                    <button @click="decrement"><i class="fa-solid fa-minus"></i></button>
                    <div class="item-qty">
                        <span id="qty">{{ quantity }}</span>
                    </div>
                    <button @click="increment"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
            <div class="cart-card card-block" v-if="productData.length > 0">
                <div class="cart-cardPic-group">
                    <div class="drop">
                        <button class="item-drop">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                    <div class="item-pic">
                        <img :src="productData[0].image" alt="">
                    </div>
                </div>
                <div class="item-info">
                    <a class="item-name" href="#">
                        {{ productData[0].title }}
                    </a>
                    <div class="item-price">
                        <span>{{ productData[0].price }}</span>
                    </div>
                </div>
                <div class="btn-group">
                    <button @click="decrement"><i class="fa-solid fa-minus"></i></button>
                    <div class="item-qty">
                        <span id="qty">{{ quantity }}</span>
                    </div>
                    <button @click="increment"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="checkOut">
                <button class="btn-checkOut" @click="goCartInfo">確認</button>
        </div>
    </div>
</template>

<script setup>

import { ref, onMounted, defineProps, defineEmits } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

//data
const props = defineProps(['cartStatus']);
const emit = defineEmits(['closeCart', 'goCartInfo']);

// const productData = ref([]);
// let quantity = ref(1);
// const router = useRouter();
const productData = ref([]);
let quantity = ref(1);
const router = useRouter();

// 取得API
onMounted(() => {
fetch('/data/productData.json')
    .then(res => res.json())
    .then(json => {
            productData.value = json;
        });
});

// 規格按鈕
    const increment = () => {
        if (quantity.value < 10) {
            quantity.value++;
        }
    };
    const decrement = () => {
        if (quantity.value > 1) {
            quantity.value--;
        }
    };
// 關閉視窗按鈕
    const closeCart = () => {
        emit('closeCart')
    }
// 前往購物車清單
    const goCartInfo = () =>{
        emit('goCartInfo')
    }
    
</script>
