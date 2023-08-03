<!-- 使用者評價星星 -->
<template>
    <div class="user_evaluate_box">
        <i class="fa-regular fa-star" v-show="toggle" v-for="item in starts_num" ref="hover_star" @click="fixed_stars(item)"
            @mouseenter="add_stars(item)" @mouseleave="remove_stars(item)"></i>
        <i class="fa-regular fa-star" @click="fixed_stars(item)" v-show="!toggle" v-for="item in starts_num"
            ref="click_star"></i>
    </div>
</template>

<script>
export default {
    data() {
        return {
            starts_num: 5,
            toggle: true,
            final_stars_num: 0
        }
    },
    methods: {
        add_stars(item1) {
            let i = 0;
            this.$refs.hover_star.forEach((item) => {
                if (i < item1) {
                    item.classList.add('fa-solid')
                }
                i++
            })
        },
        remove_stars(item2) {
            let i = 0;
            this.$refs.hover_star.forEach((item) => {
                if (i < item2) {
                    item.classList.remove('fa-solid')
                }
                i++
            })
        },
        fixed_stars(item3) {

            this.$refs.click_star.forEach((item) => {
                item.classList.remove('fa-solid')
            })
            let i = 0;
            this.$refs.click_star.forEach((item) => {
                if (i < item3) {
                    item.classList.add('fa-solid')
                }
                i++
            })
            this.toggle = false;
            this.final_stars_num = item3
            alert( this.final_stars_num)
        },
    },
}
</script>
<style lang="scss" scoped>
.user_evaluate_box {
    margin: 200px auto;
    border-radius: 8px;
    border: 5px solid black;
    width: 500px;
    height: 600px;
    display: flex;
    justify-content: center;
    align-items: center;
    i {
        font-size: 50px;
    }
}
</style>