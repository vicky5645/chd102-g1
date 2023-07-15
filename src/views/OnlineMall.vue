<template>
  <main>
      <BreadCrumbs detailName="所有商品" />
      <ol class="breadCrumbs">
          <i class="fa-solid fa-house"></i>
          <li v-for="item in [...breadCrumbs]" :key="item.index">
              <a :href="item.link" :style="item.color">
                  {{item.index}}</a>
          </li>
      </ol>
      <div class="container">
        <div class="category">
            <h3>商品分類</h3>
            <ul class="categoryItem">
                <li v-for="(item, key) in categoryItem"
                @click="updateTab(key)">
                    {{item}}<i class="fa-solid fa-chevron-right"></i>
                </li>
            </ul>
        </div>
        <div class="product">
            <div class="topBar">
                <h2>所有商品</h2>
                <div class="searchBar">
                    <input type="search" placeholder="輸入關鍵字查詢" v-model="search">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div class="productList row row-cols-lg-3" v-if="tabActive == 1">
                <div v-for="(item,index) in [...goods]" :key="item.id" class="col">
                    <div class="card">
                        <div class="cradPic">
                            <img :src="item.img">
                            <button class="cardFavorite" @click="toggleFavorite(index)">
                                <i :class="favoriteIcon(index)"></i>
                            </button>
                            <button class="cardCart">
                                <i :class="goodsBtn.cart.i"></i>
                            </button>
                        </div>
                        <h3>{{item.name}}</h3>
                        <div class="price">
                            <span>{{item.price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="productList row row-cols-lg-3"
            v-else-if="tabActive == 2">
                <div v-for="(item,index) in [...goods]" :key="item.id" class="col">
                    <div class="card">
                        <div class="cradPic">
                            <img :src="item.img">
                            <button class="cardFavorite" @click="toggleFavorite(index)">
                                <i :class="favoriteIcon(index)"></i>
                            </button>
                            <button class="cardCart">
                                <i :class="goodsBtn.cart.i"></i>
                            </button>
                        </div>
                        <h3>{{item.name}}</h3>
                        <div class="price">
                            <span>{{item.price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="productList row row-cols-lg-3"
            v-else-if="tabActive == 3">
                <div v-for="(item,index) in [...goods]" :key="item.id" class="col" v-show="item.type === '食品'">
                    <div class="card">
                        <div class="cradPic">
                            <img :src="item.img">
                            <button class="cardFavorite" @click="toggleFavorite(index)">
                                <i :class="favoriteIcon(index)"></i>
                            </button>
                            <button class="cardCart">
                                <i :class="goodsBtn.cart.i"></i>
                            </button>
                        </div>
                        <h3>{{item.name}}</h3>
                        <div class="price">
                            <span>{{item.price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="productList row row-cols-lg-3"
            v-else-if="tabActive == 4">
                <div v-for="(item,index) in [...goods]" :key="item.id" class="col">
                    <div class="card">
                        <div class="cradPic">
                            <img :src="item.img">
                            <button class="cardFavorite" @click="toggleFavorite(index)">
                                <i :class="favoriteIcon(index)"></i>
                            </button>
                            <button class="cardCart">
                                <i :class="goodsBtn.cart.i"></i>
                            </button>
                        </div>
                        <h3>{{item.name}}</h3>
                        <div class="price">
                            <span>{{item.price}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
</template>

<script>
import BreadCrumbs from '@/components/BreadCrumbs.vue'
export default {
    components: {
    BreadCrumbs
    },
    data() {
        return {
            search: '',
            goodsBtn: {
            fillHeart: {
                i: "fa-solid fa-heart"
            },
            hollowHeart: {
                i: "fa-regular fa-heart"
            },
            cart: {
                i: "fa-solid fa-cart-shopping"
            }
            },
            breadCrumbs: [
                {
                    index: "Goods",
                    link: "index.html",
                    color: "color:#9CA3AF;"
                },
                {
                    index: "Detail",
                    link: "detail.html",
                    color: "color:#9CA3AF;"
                },
                {
                    index: "Pricing",
                    link: "pricing.html",
                    color: "color:#F29C50;"
                }
            ],
        tabActive: 1,
        categoryItem: {
            1: "所有商品",
            2: "熱銷商品",
            3: "分類1",
            4: "分類2"
        },
        goods: [
        {
            id: 1,
            name: "火車叉叉",
            type: "周邊商品",
            img: require("../assets/images/online-mall/fork.png"),
            price: 300,
            isFavorite: false
        },
        {
            id: 2,
            name: "車車模型",
            type: "周邊商品",
            img: require("../assets/images/online-mall/Train_model.png"),
            price: 890,
            isFavorite: false
        },
        {
            id: 3,
            name: "車車吊牌",
            type: "周邊商品",
            img: require("../assets/images/online-mall/Keychain_pendant_B.png"),
            price: 200,
            isFavorite: false
        },
        {
            id: 4,
            name: "超讚大獎章",
            type: "周邊商品",
            img: require("../assets/images/online-mall/Badge.png"),
            price: 300,
            isFavorite: false
        },
        {
            id: 5,
            name: "車車手帕",
            type: "周邊商品",
            img: require("../assets/images/online-mall/Towel.png"),
            price: 100,
            isFavorite: false
        },
        {
            id: 6,
            name: "車車便當",
            type: "食品",
            img: require("../assets/images/online-mall/Train_bento_box.png"),
            price: 120,
            isFavorite: false
        },
        {
            id: 7,
            name: "車車吊飾",
            type: "周邊商品",
            img: require("../assets/images/online-mall/Keychain_pendant_A.png"),
            price: 250,
            isFavorite: false
        }
        ]
    }
    },
    computed: {
    },
    methods: {
        updateTab (index) {
            this.tabActive = index
        },
        toggleFavorite(index) {
            this.goods[index].isFavorite = !this.goods[index].isFavorite;
        },
        favoriteIcon(index) {
            return this.goods[index].isFavorite ? this.goodsBtn.fillHeart.i : this.goodsBtn.hollowHeart.i;
        }
    }
}
</script>


<style lang="scss" scoped>

main{
    max-width: 1200px;
    margin: auto;
}
.breadCrumbs {
    margin: 10px 0;

    i {
        color: #F29C50;
        margin-right: 10px;
    }

    li {
        &+li::before {
            content: " > ";
            color: #9CA3AF;
        }

        list-style: none;
        display: inline;

        a {
            text-decoration: none;
        }
    }
}
.container{
    display: flex;
    justify-content: space-between;
    // max-width: 1200px;
}
.category {
    width: 30%;
    h3 {
        color: #7AACBF;
        margin-bottom: 10px;
        height: 44px;
    }

    .categoryItem {
        background-color: #fff;
        border: 1px solid #D1D5DB;
        border-radius: 7px;
        box-sizing: border-box;

        li {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;

            &:hover {
                background-color: #b1cde233;
            }
        }
    }
}

.product {
    width: 68.333333%;
    .topBar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 44px;
        margin-bottom: 10px;
        h2 {
            color: #012840;
            font-size: 32px;
            line-height: 36px;
        }

        .searchBar {
            width: 300px;
            height: 44px;
            display: flex;
            border-radius: 7px;
            border: 1px solid #D1D5DB;
            box-sizing: border-box;
            background-color: #fff;

            input[type="search"] {
                background-color: unset;
                width: 100%;
                font-size: 20px;
                padding: 12px;
                border: none;

                &::-webkit-search-cancel-button,
                &::-webkit-search-decoration {
                    display: none;
                }

                &:focus {
                    outline: none;
                }
            }

            button {
                padding: 10px;
                background-color: unset;
                border: none;
                font-size: 0;
                cursor: pointer;

                &:hover i {
                    color: #F29C50;
                    transform: scale(1.1);
                }

                i {
                    font-size: 24px;
                }
            }
        }
    }
}

.card{
    width: 260px;
    padding: 10px;
    border: 1px solid #D1D5DB;
    box-sizing: border-box;
    border-radius: 7px;
    background-color: #fff;
    box-shadow: 10px #00000033;
    &:hover{
        transform: scale(1.02);
        transition: .2s;
        box-shadow: 2px 2px 10px #00000033;
    }
    .cradPic{
        border-radius: 7px;
        border: 1px solid #D1D5DB;
        box-sizing: border-box;
        overflow: hidden;
        margin-bottom: 30px;
        aspect-ratio: 1/1;
        position: relative;
        $btnSize: 45px;
        //收藏及購物車的長寬
        img{
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .cardFavorite,
        .cardCart{
            font-size: 24px;
            position: absolute;
            width: $btnSize;
            height: $btnSize;
            background-color: #fff;
            color: #F29C50;
            border: 1px solid #F29C50;;
            border-radius: 7px;
            left: 5px;
            top: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            svg{
                fill: #F29C50;
            }
        }
        .cardCart{
            top: calc($btnSize + 10px);

        }
    }
    h3{
        margin-bottom: 30px;
    }
    .price{
        span{
            &::before {
                content: " $ ";
            }
        }
    }
}
</style>