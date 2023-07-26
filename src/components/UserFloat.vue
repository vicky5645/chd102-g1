<template>
    <div class="userPage userFloat" v-show="userStatus">
        <!-- <div class="closeMark" @click="closeUser">
            <i class="fa-solid fa-xmark"></i>
        </div> -->
        <div class="link-list">
            <router-link to="/user/info">
                <li>
                    <div class="icon-24">
                        <img class="custom-svg" src="@/assets/images/icon/basic/member-login.svg" alt="list-icon">
                    </div>
                    <span>Hello, {{ $store.state.name }}</span>
                    <img class="custom-svg" src="@/assets/images/icon/basic/settings.svg" alt="settings-icon">
                </li>
            </router-link>
            <router-link to="/user/order">
                <li>
                    <img class="custom-svg" src="@/assets/images/icon/basic/list.svg" alt="list-icon">
                    <span>訂單管理</span>
                </li>
            </router-link>
            <router-link to="/user/forum">
                <li>
                    <img class="custom-svg" src="@/assets/images/icon/basic/message_writing.svg" alt="message_writing">
                    <span>論壇訊息</span>
                </li>
            </router-link>
            <router-link to="/user/like">
                <li>
                    <div class="icon-24">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <span>我的收藏</span>
                </li>
            </router-link>
            <router-link to="/login" class="login" @click="signOut">
                <li>
                    登出
                </li>
            </router-link>
        </div>
    </div>
</template>

<script setup>

import { ref, onMounted, defineProps, defineEmits } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

//data
const props = defineProps(['userStatus']);
const emit = defineEmits(['closeUser', 'goLoginUser']);

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

// 關閉視窗按鈕
const closeUser = () => {
    emit('closeUser')
}
// 前往購物車清單
const goLoginUser = () => {
    emit('goLoginUser')
}

</script>
