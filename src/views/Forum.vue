<!-- 論壇 -->
<template>
  <main class="Forum">
    <!-- 頁面標題 -->
    <div class="button_and_search">
      <div class="button_list">
        <button class="selected_button">所有</button>
        <button class="hot_button">熱門</button>
      </div>

      <div class="search_bar">
        <input
          v-model="searchText"
          type="search"
          placeholder="輸入關鍵字查詢"
        />
        <button @click="searchArticles">搜尋</button>
      </div>
    </div>

    <!-- 文章列表 -->
    <div v-for="post in filteredPosts" :key="post.id" class="post_list">
      <div class="post_content">
        <div class="avatar">
          <img :src="post.avatar" alt="" />
        </div>

        <div class="name_and_data">
          <div class="name">{{ post.name }}</div>
          <div class="data">{{ post.data }}</div>
        </div>
      </div>

      <div class="post_pic"><img :src="post.image" alt="Post Image" /></div>
      <h2 class="post_title">{{ post.title }}</h2>
      <p class="post_txt">{{ post.content }}</p>

      <!-- 功能按鈕 -->
      <div class="button_list">
        <button class="b_like" @click="likePost(post)">
          <img src="../assets/images/img/Forum/like.svg" alt="like" />
          <span>{{ post.likes }}</span>
        </button>
        <button class="b_message" @click="showArticle(post.id)">
          <img src="../assets/images/img/Forum/message.svg" alt="message" />
          <span>{{ post.comments }}</span>
        </button>
        <button class="b_share" @click="togglePopup(post)">
          <img src="../assets/images/img/Forum/share.svg" alt="share" />
          <div v-if="post.showPopup" id="popup" class="share_list">
            <div>
              <img src="../assets/images/img/Forum/s_fb.svg" alt="fb" />
            </div>
            <div>
              <img src="../assets/images/img/Forum/s_line.svg" alt="line" />
            </div>
            <div>
              <img src="../assets/images/img/Forum/s_ins.svg" alt="ins" />
            </div>
            <div>
              <img
                src="../assets/images/img/Forum/s_twitter.svg"
                alt="twitter"
              />
            </div>
          </div>
        </button>
      </div>
    </div>

    <!-- 文章詳細視窗 -->
    <div v-if="selectedPost" class="post_modal">
      <div class="post_content">
        <!-- 關閉按鈕 -->
        <button class="b_close" @click="closeArticle">
          <img src="../assets/images/img/Forum/close.svg" alt="close" />
        </button>
        <div class="avatar">
          <img :src="selectedPost.avatar" alt="" />
        </div>

        <div class="name_and_data">
          <div class="name">{{ selectedPost.name }}</div>
          <div class="data">{{ selectedPost.data }}</div>
        </div>

        <!-- 檢舉/刪除按鈕 -->
        <div class="post_more_block">
          <button class="post_more" @click.stop="toggleMenu" ref="button">
            <img src="../assets/images/img/Forum/more_dots.svg" alt="" />
          </button>
          <div v-show="showMenu" class="popup_content" ref="menu">
            <button @click="toggleDelete">刪除文章</button>
            <button @click="toggleReport">檢舉文章</button>
          </div>
        </div>
      </div>

      <div class="post_pic">
        <img :src="selectedPost.image" alt="Post Image" />
      </div>
      <h2 class="post_title">{{ selectedPost.title }}</h2>
      <p class="post_txt">{{ selectedPost.content }}</p>

      <!-- 功能按鈕 -->
      <div class="button_list">
        <button class="b_like" @click="likePost(selectedPost)">
          <img src="../assets/images/img/Forum/like.svg" alt="like" />
          <span>{{ selectedPost.likes }}</span>
        </button>

        <button class="b_message">
          <img src="../assets/images/img/Forum/message.svg" alt="message" />
          <span>{{ selectedPost.comments }}</span>
        </button>

        <button class="b_share" @click="togglePopup(selectedPost)">
          <img src="../assets/images/img/Forum/share.svg" alt="share" />
          <div v-if="selectedPost.showPopup" id="popup" class="share_list">
            <div>
              <img src="../assets/images/img/Forum/s_fb.svg" alt="fb" />
            </div>
            <div>
              <img src="../assets/images/img/Forum/s_line.svg" alt="line" />
            </div>
            <div>
              <img src="../assets/images/img/Forum/s_ins.svg" alt="ins" />
            </div>
            <div>
              <img
                src="../assets/images/img/Forum/s_twitter.svg"
                alt="twitter"
              />
            </div>
          </div>
        </button>
      </div>

      <!-- 留言  -->
      <div class="talk_bar">
        <input type="text" placeholder="分享點心得吧 ~ " />
        <button>留言</button>
      </div>

      <div
        class="message_list"
        v-for="message in posts_message"
        :key="message.id"
      >
        <div class="message_list_row">
          <div class="message_avatar_name">
            <div class="message_avatar">
              <img :src="message.avatar" alt="avatar" />
            </div>
            <div class="message_name">{{ message.name }}</div>
          </div>
          <div class="message_txt">{{ message.txt }}</div>
        </div>
      </div>

      <!-- 刪除文章視窗 -->
      <div v-if="showDeleteModal">
        <div class="modal-overlay"></div>
        <div class="modal">
          <div class="modal_title">您確定要刪除此文章嗎？</div>
          <div class="modal_button_list">
            <button @click="confirmDelete" class="b_sure">確定</button>
            <button @click="cancelDelete">取消</button>
          </div>
        </div>
      </div>

      <!-- 檢舉文章視窗 -->
      <div v-if="showReportModal">
        <div class="modal-overlay"></div>

        <div class="modal">
          <div class="modal_title">您確定要檢舉此文章嗎？</div>
          <div class="modal_button_list">
            <button @click="confirmReport" class="b_sure">確定</button>
            <button @click="cancelReport">取消</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      posts: [
        {
          id: 1,
          avatar: require("../assets/images/img/Forum/ava1.png"),
          data: "6/23 20:38",
          name: "Lily",
          image: require("../assets/images/img/Forum/f1.png"),
          title: "首次的蒸汽火車體驗",
          content:
            "這是我第一次參加蒸汽火車之旅，體驗真是太棒了！從車窗外看著湖光山色，我感受到了旅行的悠閒與寧靜。整個行程由專業的導遊詳細解說，使我對這段旅程有更深的理解。我會向所有人推薦『漫遊列車之旅』。",
          likes: 0,
          comments: 0,
          showPopup: false,
        },
        {
          id: 2,
          avatar: require("../assets/images/img/Forum/ava1.png"),
          data: "6/17 15:22",
          name: "Aric",
          image: require("../assets/images/img/Forum/f2.jpg"),
          title: "蒸汽火車與手工藝品的完美結合",
          content:
            "這次的旅程不僅讓我體驗了蒸汽火車的迷人魅力，還有機會參與當地的手工藝品製作。這種獨特的體驗讓我深深感受到當地的文化和傳統。",
          likes: 0,
          comments: 0,
          showPopup: false,
        },
        {
          id: 3,
          avatar: require("../assets/images/img/Forum/ava1.png"),
          data: "6/6 09:17",
          name: "Amy",
          image: require("../assets/images/img/Forum/f3.jpg"),
          title: "永續旅遊的承諾",
          content:
            "我非常欣賞『漫遊列車之旅』對於永續旅遊的承諾。知道我的旅程能夠為保護地球出一份力，我覺得非常的開心和有意義。",
          likes: 0,
          comments: 0,
          showPopup: false,
        },
        {
          id: 4,
          avatar: require("../assets/images/img/Forum/ava1.png"),
          data: "6/1 18:50",
          name: "Beeeeee",
          image: require("../assets/images/img/Forum/f4.jpg"),
          title: "美食與美景的雙重享受",
          content:
            "參加了『漫遊列車之旅』的美食之旅，我體驗到了美食與美景的完美結合。優美的風景和美味的食物，讓我在這次的旅程中得到了前所未有的快樂。",
          likes: 0,
          comments: 0,
          showPopup: false,
        },
      ],
      // 分類按鈕
      selectedType: "所有",

      // 文章詳細視窗
      selectedPost: null, // 選定的文章預設為空

      // 文章留言
      posts_message: [
        {
          id: 1,
          avatar: require("../assets/images/img/Forum/ava2.png"),
          name: "peter",
          txt: "我完全同意你的感受！我上個月也參加了這個旅程，從湖泊到草原的風景真的令人難以忘懷。導遊的專業解說也增添了旅程的樂趣。",
        },
        {
          id: 2,
          avatar: require("../assets/images/img/Forum/ava2.png"),
          name: "Amy",
          txt: "看了你的分享，我也很期待自己的蒸汽火車之旅！已經在計劃中了，希望能和你一樣有個美好的體驗。",
        },
        {
          id: 3,
          avatar: require("../assets/images/img/Forum/ava2.png"),
          name: "wendy",
          txt: "我非常同意你的看法！我也是第一次體驗蒸汽火車旅行，感覺就像被帶回了過去。那種獨特的懷舊風情讓人難以忘懷。",
        },
      ],

      // 搜尋功能_現有的屬性...
      searchText: "",
      filteredPosts: [],

      // 檢舉
      showMenu: false, // 控制菜单的显示或隐藏
      // 檢舉選單
      showMenu: false,
      showDeleteModal: false,
      showReportModal: false,
    };
  },

  methods: {
    // 按讚文章
    likePost(post) {
      post.likes++; // 將該文章的讚數加1
    },

    // 顯示文章詳細視窗
    showArticle(postId) {
      this.selectedPost = this.posts.find((post) => post.id === postId);
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    },

    // 關閉文章詳細視窗
    closeArticle() {
      this.selectedPost = null;
    },

    // 搜尋
    searchArticles() {
      // 若搜尋欄位為空，則返回所有文章
      if (!this.searchText.trim()) {
        this.filteredPosts = this.posts;
      } else {
        const lowerCaseSearchText = this.searchText.toLowerCase(); // 轉小寫
        this.filteredPosts = this.posts.filter(
          (post) =>
            post.name.toLowerCase().includes(lowerCaseSearchText) || // 搜索作者名称
            post.data.toLowerCase().includes(lowerCaseSearchText) || // 搜索日期
            post.title.toLowerCase().includes(lowerCaseSearchText) || // 搜索标题
            post.content.toLowerCase().includes(lowerCaseSearchText) // 搜索内容
        );
      }
    },

    // 分享文章
    togglePopup(post) {
      post.showPopup = !post.showPopup;
    },

    // 檢舉文章
    toggleMenu() {
      this.showMenu = !this.showMenu; // 切换菜单的显示或隐藏
    },

    // 檢舉選單
    toggleDelete() {
      this.showDeleteModal = true;
      this.showMenu = false;
    },
    toggleReport() {
      this.showReportModal = true;
      this.showMenu = false;
    },
    handleClickOutside(e) {
      const menuEl = this.$refs.menu;
      const buttonEl = this.$refs.button;
      // 檢查 menuEl 是否被正確渲染
      if (
        menuEl &&
        menuEl.$el &&
        !(menuEl.$el.contains(e.target) || buttonEl.$el.contains(e.target))
      ) {
        this.showMenu = false;
      }
    },
    confirmDelete() {
      // 在此處實現刪除文章的邏輯
      this.showDeleteModal = false;
    },
    cancelDelete() {
      this.showDeleteModal = false;
    },
    confirmReport() {
      // 在此處實現檢舉文章的邏輯
      this.showReportModal = false;
    },
    cancelReport() {
      this.showReportModal = false;
    },
  },

  mounted() {
    // 當組件被加載時，執行一次搜尋，顯示所有帖子
    this.searchArticles();

    // 檢舉選單
    document.addEventListener("click", this.handleClickOutside);
  },
  beforeDestroy() {
    // 檢舉選單
    document.removeEventListener("click", this.handleClickOutside);
  },
};
</script>
