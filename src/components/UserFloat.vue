<template>
    <div class="userPage cartFloat" v-show="userStatus">
        <div class="link-list">
            <router-link to="/user">
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
            <router-link to="/login" class="login" @click="handleLogout">
                <li>
                    登出
                </li>
            </router-link>
        </div>
    </div>
    <div class="userPageMask" v-show="userStatus" @click="closeUser"></div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

//data
const props = defineProps(['userStatus']);
const emit = defineEmits(['closeUser', 'goLoginUser']);

const store = useStore();
const router = useRouter();

const signOut = function () {
    // 登出
    store.commit('setName', '登入/註冊');
    store.commit('setIsLogin', false); // 使用 commit 來改變狀態
    router.push('/roaming-orbit');
}

// 關閉視窗按鈕
const closeUser = () => {
    emit('closeUser')
}

// 登出並且隱藏選單
const handleLogout = () => {
    signOut(); // 執行 signOut 方法
    closeUser(); // 關閉會員選單
}

</script>

<style lang="scss" scoped>
.userPageMask {
    background-color: transparent;
    width: 100vw;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;
}
</style>