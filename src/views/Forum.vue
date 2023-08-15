<!-- 論壇 -->
<template>
  <main class="Forum">
    <!-- 頁面標題 -->
    <div class="button_and_search">
      <div class="button_list">
        <button
          ref="allButton"
          class="selected_button active"
          @click="returnOriginal"
        >
          所有
        </button>
        <button ref="hotButton" class="hot_button" @click="hotPostSort">
          熱門
        </button>
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
            <!-- <Images :imgURL="post.avatar" :alt="`Image preview`" /> -->
          </div>

          <div class="name_and_data">
            <div class="name">{{ post.name }}</div>
            <div class="data">{{ post.data }}</div>
          </div>
        </div>

        <div class="post_pic">
          <!-- <img :src="post.image" alt="Post Image" /> -->
          <Images :imgURL="`${post.image}`" :alt="`Image preview`" />
        </div>

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
            <!-- <span>{{ post.comments }}</span> -->
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
          ref="postFormPic"
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

        <!-- BUG -->
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
        <img :src="selectedPost.image" alt="Post Image" ref="forumPic" />
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
        <input
          type="text"
          v-model="addForumMessage.commen_content"
          placeholder="分享點心得吧 ~ "
        />
        <button @click="addForumMessageData(selectedPost.id)">留言</button>
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
            <button @click="deleteForumData(selectedPost.id)" class="b_sure">
              確定
            </button>
            <button @click="cancelDelete">取消</button>
          </div>
        </div>
      </div>

      <!-- 檢舉文章視窗 -->
      <div v-if="showReportModal">
        <div class="modal-overlay"></div>

        <div class="modal">
          <div class="modal_title">您確定要檢舉此文章嗎？</div>
          <input
            v-model="reportReason"
            type="text"
            placeholder="請描述檢舉原因"
            maxlength="100"
          />
          <div v-if="reportError" class="error">{{ reportError }}</div>

          <div class="modal_button_list">
            <button @click="confirmReport(selectedPost.id)" class="b_sure">
              確定
            </button>
            <button @click="cancelReport">取消</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 通知吐司 -->
    <div id="toast"></div>
  </main>
</template>

<script>
// 新增文章
import axios from "axios";
import { ref, watch, onMounted } from "vue";
import { BASE_URL } from "@/assets/js/common.js";

import { useRouter } from "vue-router";

export default {
  data() {
    return {
      posts: [],
      // 分類按鈕
      selectedType: "所有",

      // 文章詳細視窗
      selectedPost: null, // 選定的文章預設為空
      posts_message: [],

      // 搜尋功能_現有的屬性...
      searchText: "",
      filteredPosts: [],

      // 檢舉
      showMenu: false, // 控制菜单的显示或隐藏
      // 檢舉選單
      showMenu: false,
      showDeleteModal: false,
      showReportModal: false,
      // 檢舉文字框
      reportReason: "",
      reportError: "",
      getdataArr: "",
    };
  },

  methods: {
    // 按讚文章
    // async likePost(post) {
    //   // 假設每次點擊都增加1個讚
    //   post.article_likes += 1;

    //   try {
    //     const response = await axios.post(
    //       `${BASE_URL}postFrontForumArticleLike.php`,
    //       {
    //         article_no: post.article_no,
    //         likeIncrement: 1, // 增加一個讚
    //       }
    //     );

    //     // 檢查後端的響應
    //     if (response.data.status !== "success") {
    //       // 如果後端更新失敗，還原前端的讚數
    //       post.article_likes -= 1;
    //       alert(response.data.message);
    //     }
    //   } catch (err) {
    //     // 如果請求失敗，還原前端的讚數
    //     post.article_likes -= 1;
    //     alert("更新讚數時發生錯誤。請稍後再試。");
    //     console.error(err);
    //   }
    // },

    // 顯示文章詳細視窗

    // showArticle(postId) {
    //   this.selectedPost = this.posts.find((post) => post.id === postId);
    //   window.scrollTo({
    //     top: 0,
    //     behavior: "smooth",
    //   });
    //   this.getForumMessageData(postId);
    // },

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
      if (this.reportReason.length === 0) {
        this.reportError = "* 請輸入檢舉原因";
      } else if (this.reportError === "") {
        console.log(this.reportReason);
        this.showReportModal = false;
        this.reportReason = "";
      }
    },
    cancelReport() {
      this.showReportModal = false;
    },
  },

  created() {
    this.getForumData();
    // console.log(this.contentError)
  },

  mounted() {
    // 當組件被加載時，執行一次搜尋，顯示所有帖子
    this.searchArticles();

    // 檢舉選單
    document.addEventListener("click", this.handleClickOutside);
  },

  watch: {
    reportReason(newValue) {
      if (newValue.length === 0) {
        this.reportError = "* 請輸入檢舉原因";
      } else if (newValue.length < 10) {
        this.reportError = "* 您的描述至少需要10個字";
      } else {
        this.reportError = "";
      }
    },
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
    const postFormPic = ref(null);
    let posts = ref([]);
    let filteredPosts = ref([]);
    let posts_message = ref([]);
    const forumPic = ref(null);
    const router = useRouter();
    const showReportModal = ref(false); // 控制檢舉模态框的显示
    const reportReason = ref(""); // 存储檢舉的原因
    const reportError = ref(""); // 存储檢舉时的错误信息
    const commentError = ref("");
    let selectedPost = ref(null);
    const allButton = ref(null);
    const hotButton = ref(null);
    const toast = ref(null);

    // let hasBeenLiked = false;
    // const reportReason = ref("");

    const likedPosts = new Set(); // 用於追踪已被按讚的文章的 Set

    let addForumMessage = ref({ article_no: 1, mem_no: 1, commen_content: "" });
    let reportDetails = ref({
      article_no: 1,
      mem_no: 1, // 先寫死1
      report_content: reportReason,
    });

    const addArticleObject = ref({
      title,
      content,
      image: null,
      mem_no: 1,
      article_views: 0,
      article_likes: 0,
      platform_online: 0,
      article_image: null,
    });

    // console.log(selectedPost);

    //抓文章資料
    const getForumData = async () => {
      posts.value = [];
      try {
        const res = await axios.get(`${BASE_URL}getFrontForumArticle.php`);
        if (!res) throw new Error("沒抓到資料");
        res.data.forEach((element) => {
          let {
            article_no: id,
            article_title: title,
            article_content: content,
            mem_no,
            article_date: data,
            article_views,
            article_likes: likes,
            platform_online,
            article_image: image,
            mem_name: name,
          } = element;
          image = `images/img/Forum/${image.split("/").pop()}`;
          posts.value.push({
            id,
            title,
            content,
            name,
            mem_no,
            data,
            article_views,
            likes,
            platform_online,
            image,
            avatar: "images/img/Forum/ava1.png",
            comments: 0,
            showPopup: false,
          });
        });
        filteredPosts.value = [...posts.value];
      } catch (err) {
        console.error(err);
      }
    };

    ///抓文章留言資料
    const getForumMessageData = async (postId) => {
      posts_message.value = [];
      try {
        const formData = new FormData();
        formData.append("id", postId);
        const res = await axios.post(
          `${BASE_URL}getFrontForumMessage.php`,
          formData
        );
        if (!res) throw new Error("沒抓到資料");
        res.data.forEach((element) => {
          let {
            comment_no: id,
            article_no,
            mem_no,
            mem_name: name,
            commen_content: txt,
          } = element;
          posts_message.value.push({
            id,
            article_no,
            mem_no,
            name,
            txt,
            avatar: "images/img/Forum/ava2.png",
            // avatar
          });
        });
      } catch (err) {
        console.error(err);
      }
    };

    // 顯示文章詳細視窗
    const showArticle = (postId) => {
      console.log(postId);
      console.log(posts.value);
      posts.value.forEach((post) => {
        console.log(post.id);
      });
      selectedPost.value = posts.value.find((post) => post.id === postId);
      console.log(selectedPost);
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
      getForumMessageData(postId);
    };

    // 新增文章
    const addForumData = async () => {
      try {
        const formData = new FormData();
        Object.keys(addArticleObject.value).forEach((key) => {
          formData.append(`${key}`, addArticleObject.value[key]);
        });
        formData.set("image", postFormPic.value.files[0]);
        const res = await axios.post(
          `${BASE_URL}postFrontForumArticle.php`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        alert(`${res.data.msg}`);
      } catch (err) {
        console.error(err);
      }
    };

    // 臨時頁面
    const reloadPage = () => {
      router.go(0);
    };

    // 刪除文章
    const deleteForumData = async (articleNo) => {
      console.log(forumPic.value.src.split());

      try {
        const formData = new FormData();

        formData.append("article_no", articleNo);
        formData.set(
          "article_image",
          `images/img/Forum/${forumPic.value.src.split("/").pop()}`
        );
        const res = await axios.post(
          `${BASE_URL}deleteFrontForum.php`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        alert(`${res.data.msg}`);
        reloadPage();
      } catch (err) {
        console.error(err);
      }
    };

    // 新增留言
    const addForumMessageData = async (articleNo) => {
      try {
        if (addForumMessage.value.commen_content.length < 8) {
          showToast("留言至少需要8個字");
          return; // 中止提交
        }
        addForumMessage.value.article_no = articleNo;
        addForumMessage.value.mem_no = 1; // 先寫死1
        const formData = new FormData();
        Object.keys(addForumMessage.value).forEach((key) => {
          formData.append(`${key}`, addForumMessage.value[key]);
        });
        const res = await axios.post(
          `${BASE_URL}postFrontForumArticleMessage.php`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        showToast(`${res.data.msg}`);

        // 清空輸入框的值
        addForumMessage.value.commen_content = "";

        // 重新獲取留言數據
        await getForumMessageData(articleNo);
      } catch (err) {
        console.error(err);
      }
    };

    // 新增檢舉
    const confirmReport = async (articleNo) => {
      try {
        if (reportReason.value.length < 10) {
          reportError.value = "請填寫檢舉原因！";
          return;
        }
        console.log(articleNo);

        reportDetails.value.article_no = articleNo;
        reportDetails.value.mem_no = 1; // 先寫死1
        const formData = new FormData();
        // formData.append("article_no", article_no.value); // 假設你有一個ref叫做 article_no
        // formData.append("mem_no", mem_no.value); // 假設你有一個ref叫做 mem_no
        Object.keys(reportDetails.value).forEach((key) => {
          formData.append(key, reportDetails.value[key]);
        });

        const res = await axios.post(
          `${BASE_URL}postFrontForumArticleReport.php`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );

        if (res.data.msg === "新增成功") {
          showReportModal.value = false;
          showToast("檢舉成功！");
          console.log("Server Response:", res.data);
        } else {
          reportError.value = "檢舉失敗，請稍後再試！";
          console.error("Error:", err);
        }
      } catch (err) {
        // console.error(err);
        // reportError.value = "檢舉失敗，請稍後再試！";
        console.error("Error:", err);
        console.error("Error Response:", err.response);
        reportError.value = "檢舉失敗，請稍後再試！";
      }

      reportReason.value = "";
    };

    const cancelReport = () => {
      showReportModal.value = false;
      reportReason.value = "";
      reportError.value = "";
    };

    // 按讚文章
    const likePost = async (post) => {
      // 檢查該文章是否已經被按讚過
      if (likedPosts.has(post.id)) {
        // alert("您已經對這篇文章按過讚了！");
        showToast("您已經對這篇文章按過讚了！");
        return;
      }

      post.article_likes += 1;
      console.log(post.id);

      // Format data as application/x-www-form-urlencoded
      const formData = new URLSearchParams();
      formData.append("article_no", post.id);
      formData.append("likeIncrement", 1); // 增加一個讚

      try {
        const response = await axios.post(
          `${BASE_URL}postFrontForumArticleLike.php`,
          formData
        );
        // ... (保持原先的響應檢查不變)
      } catch (err) {
        // 如果請求失敗，還原前端的讚數
        post.article_likes -= 1;
        alert("更新讚數時發生錯誤。請稍後再試。");
        console.error(err);
        return; // 確保不會在下面的代碼中將文章 ID 加入到 likedPosts
      }

      // 將該文章 ID 加入到已按讚的文章集合中
      likedPosts.add(post.id);

      await getForumData();
      if (selectedPost.value) {
        showArticle(post.id);
      }
    };

    // toast
    // 在组件挂载完成后，赋值给 toast
    onMounted(() => {
      toast.value = document.getElementById("toast");
    });

    // 定义 showToast 函数
    function showToast(message) {
      if (toast.value) {
        toast.value.innerHTML = message;
        toast.value.classList.add("show");
        setTimeout(() => {
          toast.value.classList.remove("show");
        }, 3000); // 3 seconds
      }
    }

    // 熱門文章排序
    const hotPostSort = async () => {
      filteredPosts.value = [...posts.value].sort((a, b) => b.likes - a.likes);
      allButton.value.classList.remove("active");
      hotButton.value.classList.add("active");
    };
    const returnOriginal = () => {
      filteredPosts.value = [...posts.value];
      allButton.value.classList.add("active");
      hotButton.value.classList.remove("active");
    };

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

    const submitPost = async () => {
      if (title.value.trim() === "" || title.value.length < 3) {
        titleError.value = "文章標題至少需要3個字符且不能為空";
        return;
      }
      if (content.value.trim() === "" || content.value.length < 10) {
        contentError.value = "文章內容至少需要10個字符且不能為空";
        return;
      }

      // 如果有错误，不提交
      if (
        titleError.value ||
        contentError.value ||
        !postFormPic.value.files[0]
      ) {
        showToast("所有欄位都要填寫!");
        return;
      }
      await addForumData();

      getForumData();
      // 在此處處理提交後的邏輯，例如將數據發送到伺服器
      console.log(title.value, content.value, image.value);
      showForm.value = false;
      title.value = "";
      content.value = "";
      image.value = null;
      imagePreview.value = null;

      // getForumData()
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
      addArticleObject,
      addForumData,
      postFormPic,
      posts,
      filteredPosts,
      getForumData,
      getForumMessageData,
      posts_message,
      addForumMessage,
      addForumMessageData,
      deleteForumData,
      forumPic,
      reloadPage,
      confirmReport,
      cancelReport,
      showReportModal,
      reportReason,
      reportError,
      reportDetails,
      likePost,
      selectedPost,
      showArticle,
      hotPostSort,
      returnOriginal,
      allButton,
      hotButton,
      showToast,
    };
  },
};
</script>
