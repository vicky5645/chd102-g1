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
      <button class="new_button_pad" @click="showForm = true">
        <i class="fa fa-pencil" aria-hidden="true"></i> 新增文章
      </button>
    </div>

    <!-- 文章列表 -->
    <div v-if="filteredPosts.length" class="post_grid">
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
    </div>
    <!-- 當沒有文章時的提示 -->
    <div v-else class="no_posts">目前無相關文章，建議您換個關鍵字查找😣</div>

    <!-- 新增文章手機版按鈕 -->
    <button class="new_button_phone" @click="showForm = true">
      <i class="fa fa-plus" aria-hidden="true"></i>
    </button>

    <!-- 新增文章視窗 -->
    <div v-if="showForm" class="post_form">
      <div class="post_form_top">
        <button @click="showForm = false" class="post_form_back">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h3>新增文章</h3>
        <button @click="submitPost" class="post_form_submit">發布</button>
      </div>
      <div class="post_form_content">
        <input
          type="text"
          v-model="title"
          class="post_form_title"
          placeholder="輸入文章標題"
        />
        <div v-if="titleError" class="error">{{ titleError }}</div>

        <textarea v-model="content" placeholder="輸入文章內容"></textarea>
        <div v-if="contentError" class="error">{{ contentError }}</div>
        <input
          class="post_form_pic"
          type="file"
          accept=".jpg,.png"
          @change="onFileChange"
        />
        <div class="pic_preview">
          <img :src="imagePreview" v-if="imagePreview" />
        </div>
      </div>
    </div>

    <!-- 文章詳細視窗 -->
    <div v-if="selectedPost" class="post_modal">
      <div class="post_top">
        <!-- 關閉按鈕 -->
        <button class="b_close" @click="closeArticle">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
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
            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
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

        <!-- <button class="b_message">
          <img src="../assets/images/img/Forum/message.svg" alt="message" />
          <span>{{ selectedPost.comments }}</span>
        </button> -->

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
// 新增文章
import { ref, watch } from "vue";

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

  // 新增文章
  setup() {
    const showForm = ref(false);
    const title = ref("");
    const content = ref("");
    const image = ref(null);
    const imagePreview = ref(null);
    const titleError = ref("");
    const contentError = ref("");

    watch(title, (newValue) => {
      if (newValue.trim() === "" || newValue.length < 8) {
        titleError.value = "* 文章標題至少需要8個字符";
      } else {
        titleError.value = "";
      }
    });

    watch(content, (newValue) => {
      if (newValue.trim() === "" || newValue.length < 20) {
        contentError.value = "* 文章內容至少需要20個字符";
      } else {
        contentError.value = "";
      }
    });

    const onFileChange = (e) => {
      const file = e.target.files[0];
      const fileType = file.type;

      // 驗證文件類型
      if (fileType !== "image/jpeg" && fileType !== "image/png") {
        alert("請選擇一個.jpg或.png的圖片文件。");
        return;
      }

      // 使用 FileReader 讀取圖片
      const reader = new FileReader();
      reader.onload = (e) => {
        imagePreview.value = e.target.result;
      };
      reader.readAsDataURL(file);

      image.value = file;
    };

    const submitPost = () => {
      if (title.value.trim() === "" || title.value.length < 3) {
        titleError.value = "文章標題至少需要3個字符且不能為空";
        return;
      }
      if (content.value.trim() === "" || content.value.length < 10) {
        contentError.value = "文章內容至少需要10個字符且不能為空";
        return;
      }

      // 如果有错误，不提交
      if (titleError.value || contentError.value) {
        return;
      }

      // 在此處處理提交後的邏輯，例如將數據發送到伺服器
      console.log(title.value, content.value, image.value);
      showForm.value = false;
      title.value = "";
      content.value = "";
      image.value = null;
      imagePreview.value = null;
    };

    return {
      showForm,
      title,
      content,
      image,
      imagePreview,
      onFileChange,
      submitPost,
      titleError,
      contentError,
    };
  },
};
</script>
