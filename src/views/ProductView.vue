<template>
  <div class="product_container">
    <aside>
      <input type="text" v-model="searchText">
      <button @click="updateDisplay">search</button>
    </aside>
    <main v-if="productData.length > 0" class="product_list">
      <router-link 
        v-for="item in productDisplay" 
        :key="item.id"
        class="product_card"
        :to="`/productDetail/${item.id}`"
      >
        <div class="product_img">
          <img :src="item.image" alt="">
        </div>
        <p>{{ item.title }}</p>
        <p class="right">${{ item.price }}</p>
      </router-link>
    </main>
    <main v-else>
      Loading...
    </main>
  </div>
</template>

<script>
export default {
  data(){
    return {
      searchText: '',
      // 商品資料(僅在進入畫面時去取一次資料)
      productData: [],
      // 呈現的商品資料(針對productData來搜尋篩選)
      productDisplay: [],
    }
  },
  created() {
    // 取得API
    // https://fakestoreapi.com/
    // json-generator太難用了道歉ＴＴ
    fetch('https://fakestoreapi.com/products')
    .then(res=>res.json())
    .then(json=>{
      this.productData = json
      this.updateDisplay()
    })
  },
  methods: {
    updateDisplay(){
      if(this.searchText === ''){
        this.productDisplay = this.productData
      }else{
        this.productDisplay = this.productData.filter(item => item.title.includes(this.searchText))
      }
    }
  },
}
</script>

<style lang="scss">
.product{
  &_container{
    display: inline-flex;
    >aside{
      flex-basis: 10rem;
      background-color: rgb(175, 197, 197);
    }
    >main{
      flex-basis: calc(100% - 10rem);
      background-color: #dff2ea;
    }
  }
  &_list{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-column-gap: 10px;
    grid-row-gap: 10px;
    padding: 1rem;
  }
  &_card{
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    p{
      width: 15rem;
      height: 1em;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      margin-bottom: .5rem;
      &.right{
        text-align: right;
      }
    }
  }
  &_img{
    width: 15rem;
    height: 15rem;
    border-radius: 1rem;
    background-color: #fff;
    overflow: hidden;
    
    display: flex;
    align-items: center;
    justify-content: center;

    img{
      width: 60%;
    }
  }
}
</style>
