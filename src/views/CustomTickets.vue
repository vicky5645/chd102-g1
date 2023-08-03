<template>
  <section class="custom-tickets title">
    <div class="container">
      <h2 class="h2">{{ $route.meta.title }}</h2>
    </div>
  </section>
  <section class="custom-tickets">
    <div class="container">
      <div class="des label">
        <h4 class="h3">注意事項：</h4>
        <p>1. 請勿離開本頁：在進行客製車票的過程中，請確保不要離開當前頁面，否則可能導致資料丟失。</p>
        <p>2. 使用拖曳功能：您可以使用拖曳功能來調整和排列車票上的圖樣和文本。拖曳元素時，請確保放置在適當的位置，以獲得理想的設計效果。</p>
        <p>3. 設定圖樣：車票客製功能允許您設定特定的圖樣，請按照指示操作以選擇所需的圖樣。您可以從預設選項中選擇喜愛的圖片。</p>
        <p>4. 預覽和確認：在完成設定後，請先預覽車票的外觀和佈局。確保所有內容和圖樣的位置和尺寸符合您的需求。</p>
        <p>5. 輸出車票：一旦滿意設計結果，您可以點擊輸出按鈕，以生成最終版本的車票。請注意，一旦車票生成，即無法進一步編輯，請確保在輸出之前檢查所有細節。</p>
        <p>請牢記這些注意事項，並在使用客製車票功能時謹慎操作。祝您順利創作出理想的車票設計！</p>
      </div>
    </div>
  </section>
  <section class="custom-tickets ticket">
    <div class="container">
      <div class="setting">
        <!-- 色彩選擇器等元素 -->
        <input type="color" name="color" v-model="setting.color">
        <div id="leftbox" class="img-space">
          <div v-for="icon in patterns" class="cus" :style="{ color: setting.color || '#F29C50' }">
            <img :src="icon" class="custom-svg img">
          </div>
        </div>
      </div>
      {{ draggable }}
      <div class="row make">
        <div 
          id="capture"
          class="post-box t-Ani perspective card-shadow" @mouseup="onDragEnd"
          @mouseleave="onDragEnd"
          @mousemove="onDrag($event,'capture')">
          <div class="ticket-bg t-Ani" id="card">
            <!-- 車票的一些內容 -->
            <div class="h3">探尋島嶼之美，搭乘耀眼的七星豪華列車</div>
            <!-- 這裡是放置已選取圖像節點的容器 & 拖曳節點的容器 -->
            <div
              id="selected_icons"
              :style="{
                color: setting.color || '#F29C50', 
                left: `calc( ${position.x}px)`,
                top: `calc( ${position.y}px)`
                }"
              class="preserve-3d"
              @mousedown="onStart">
            </div>
          </div>
        </div>
        <div class="block">
          <div class="grid" id="block-img"></div>
        </div>
      </div>
      <div class="row">
        <div class="footer">
          <!-- 一些按鈕等元素 -->
          <button id="block-btn" class="btn" name="點我截圖"><i class="fa-solid fa-crop-simple"></i></button>
          <button id="download-btn" class="btn" name="下載圖片"> <i class="fas fa-download"></i></button>
        </div>
      </div>
      <div class="row bottom-btn">
        <router-link to="/user/order">
          <button type="submit" class="btn primary radius big">確認樣式</button>
          <span>（送出後不可更改）</span>
        </router-link>
      </div>
    </div>
  </section>
</template>

<script>
import domtoimage from "@/assets/js/dom-to-image.min.js";
export default {
  data() {
    return {
      draggable: false,
      position: {
        x: 0,
        y: 0
      },
      iconMove: {
        x: 0,
        y: 0
      },
      currentX: 0,
      currentY: 0,
      setting: {
        color: '#F29C50'
      },
      patterns: [require('../assets/images/pattern/1.svg'), require('../assets/images/pattern/2.svg'), require('../assets/images/pattern/3.svg'), require('../assets/images/pattern/4.svg')],
      isDragging: false,
    }
  },
  methods: {
    addImageToCard(icon) {
      // 加入圖片至拖曳的容器
      const useIcon = document.getElementById('selected_icons');
      //只出現一個------------------------------
      useIcon.innerHTML = icon.innerHTML
      this.draggable = true;
    },
    onStart(e) {
      // console.log("開始拖曳icon");
      this.currentX = this.position.x
      this.currentY = this.position.y
      this.isDragging = true;
    },
    onDragEnd() {
      // console.log("拖曳停止");
      this.isDragging = false;
      this.currentX = this.position.x
      this.currentY = this.position.y
    },
    onDrag(e, elementId) {
      if (!this.isDragging) return;
      // 加入圖片後，讓容器可以拖曳
      const capture = document.getElementById(elementId);
      const captureRect = capture.getBoundingClientRect();
      // console.log('滑鼠事件:', e);
      // console.log('captureRect: X , Y', captureRect);
      
      let currentX = e.clientX - captureRect.left;
      let currentY = e.clientY - captureRect.top;

      // 計算與上個座標偏移的距離
      let moveX = currentX - this.currentX;
      let moveY = currentY - this.currentY;

      this.iconMove.x = moveX;
      this.iconMove.y = moveY;
      
      this.position.x = currentX;
      this.position.y = currentY;

      // console.log('綁定的位置: X , Y', this.position.x, this.position.y,);
      // console.log('let current: X , Y', currentX, currentY,);
      // console.log('moveX: X , Y', moveX, moveY);

    },
  },
  mounted() {
    svg_icon('.custom-svg', 'currentColor');
    // 以下是客製圖片的內容------------------------------------------
    if (typeof domtoimage !== 'undefined') {
      // console.log('domtoimage is loaded!!!!!');
      const block_btn = document.getElementById('block-btn');
      const download_btn = document.getElementById('download-btn');
      // 截圖函數-----------
      function block_capture(js_plugin) {
        let node = document.getElementById("capture");
        js_plugin
          .toPng(node)
          .then(function (dataUrl) {
            let img = new Image();
            img.src = dataUrl;
            let el_block = document.querySelector("#block-img");
            el_block.appendChild(img);
            // document.body.appendChild(img);
            // console.log(img);
            // console.log(el_block.innerHTML);
          })
          .catch(function (error) {
            console.error("失敗!", error);
          });
      };
      // 下載函數-----------
      /* a標籤的download */
      function download_capture(js_plugin) {
        let node = document.getElementById("capture");
        js_plugin.toPng(node).then(function (dataUrl) {
          let a = document.createElement("a");
          a.href = dataUrl;
          a.download = "image.png";
          a.click();
        });
      };

      block_btn.addEventListener('click', function () {
        // console.log(domtoimage)
        // 呼叫 block_capture 並傳入 domtoimage 作為參數
        block_capture(domtoimage);
      })

      download_btn.addEventListener('click', function () {
        // console.log(domtoimage)
        // 呼叫 download_capture 並傳入 domtoimage 作為參數
        download_capture(domtoimage);
      })
    } else {
      console.log('domtoimage is not loaded yet.');
    }
    // 製作點按新增元素進車票----------------------------------------
    const icons = document.querySelectorAll('.cus'); // 所有換色ICON標籤
    const addImageToCardFunc = this.addImageToCard;
    icons.forEach((icon) => {
      icon.addEventListener('click', function () {
        // console.log(icon);
        // this.thisIcon = icon
        addImageToCardFunc(icon); // 呼叫 addImageToCard 函數
      })
    }); // 每個圖片增加監聽
  }
}
</script>

<style lang="scss" scoped>
[draggable="true"] {
  cursor: move;
}
</style>
