<template>
  <div class="settings">
    <h1>訂單管理</h1>
    <hr>
    {{ searchText }}
    <!-- <div class="input-wrap login">
      <input v-model="username" type="text" placeholder="" required>
      <label>搜尋</label>
    </div>
    <button @click="updateDisplay"><i class="fa-solid fa-magnifying-glass"></i>search</button> -->
    <div class="searchBar">
      <input type="search" placeholder="輸入關鍵字查詢" v-model="searchText">
      <button @click="updateDisplay"><i class="fa-solid fa-magnifying-glass"></i>search</button>
    </div>
    <!-- <div class="input-wrap login">
      <input v-model="username" type="text">
      <label>搜尋</label>
    </div> -->
    <div class="user-control-content">
      <!-- <div v-if="productData.length > 0 && tabActive == 1" class="productList row row-cols-lg-3 row-cols-2"> -->
      <div></div>
      <div v-for="item, index in productDisplay" :key="item.id" class="col">
        <div class="card">
          <div class="cradPic">
            <img :src="item.image" :alt="item.title">
          </div>
          <h3>{{ item.title }}</h3>
          <!-- <div class="avatar">
            <img src="https://picsum.photos/100/100/?random=22" alt="avatar" />
          </div> -->
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchText: '',
      productDisplay: [''],
      productData: '',
    }
  },
  created() {
    // 取得API
    fetch('/data/productData.json')
      .then(res => res.json())
      .then(json => {
        this.productData = json
        this.updateDisplay()
      })
  },
  methods: {
    updateDisplay() {
      if (this.searchText === '') {
        this.productDisplay = this.productData
      } else {
        this.productDisplay = this.productData.filter(item => item.title.includes(this.searchText))
      }
    },
    updateTab(index) {
      this.tabActive = index
    },
  },
}
</script>
