<!-- 後台行程景點 -->
<template>
  <!-- <p>{{ changeArray(1) }}</p> -->
  <!-- <p>packageData:: {{ PackageData }}</p> -->
  <!-- <p>Spot:: {{ SpotData }}</p> -->
  <br />
  <!-- select bar -->
  <div class="search_new">
    <div class="input-group">
      <input
        v-model="searchText"
        type="text"
        class="form-control"
        placeholder="輸入文字查詢"
        aria-label="Search"
      />
    </div>
    <button
      class="btn btn-outline-primary b_new"
      type="button"
      id="button-addon2"
      data-bs-toggle="modal"
      data-bs-target="#itemNewModal"
    >
      新增行程景點
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">行程編號</th>
        <th scope="col">景點排序</th>
        <th scope="col">景點編號</th>
        <th scope="col">第幾天</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(pkg, pkg_index) in PackageData" :key="index">
        <th scope="row">{{ pkg_index }}-{{ pkg }}</th>
        <th scope="row" colspan="3">
          <div
            v-for="filteredItem in changeArray(parseInt(pkg_index))"
            class="form-control"
          >
            <!-- {{ filteredItem }} -->
            <!-- 在这里可以使用 filteredItem 进行显示 -->
            {{ filteredItem.spot_sort }} | {{ filteredItem.spot_no }}.
            {{
              `${SpotData[filteredItem.spot_no]} 第${filteredItem.pkg_howday}天`
            }}
          </div>
        </th>
        <td style="text-align: right">
          <button
            type="button"
            class="btn btn-outline-primary"
            style="margin-left: auto"
            @click="openModal(changeArray(parseInt(pkg_index)), pkg_index)"
          >
            查看
          </button>
        </td>
      </tr>
    </tbody>

    <p v-if="filteredItems.length === 0" class="text-danger">
      * 沒有找到符合搜尋條件的結果
    </p>
  </table>
  <!-- edit modal -->
  <div
    v-if="showModal"
    class="modal fade"
    id="itemModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" style="max-width: auto">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">修改行程景點</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            @click="cancelChanges"
          ></button>
        </div>

        <!-- modal body -->
        <div
          style="display: flex; flex-direction: column"
          class="modal-body gap-2"
        >
          <!-- {{ currentItem }} -->
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >行程編號</span
            >
            <input
              disabled
              :value="`${currentItem_pkg_no} - ${PackageData[currentItem_pkg_no]}`"
              name="pkg_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="form-control">
            <!-- <template > -->
              <li class="form-control" v-for="(item, itemIndex) in currentItem" :key="itemIndex">
                <div class="input-group input-group-lg">
                  <span class="input-group-text" id="inputGroup-sizing-lg"
                    >景點排序</span
                  >
                  <input
                    v-model="item.spot_sort"
                    name="spot_sort"
                    type="text"
                    class="form-control"
                    aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-lg"
                  />
                </div>
                <div class="input-group input-group-lg">
                  <span class="input-group-text" id="inputGroup-sizing-lg"
                    >景點編號</span
                  >
                  <input
                    disabled
                    :value="`${item.spot_no} - ${SpotData[item.spot_no]}`"
                    name="pkg_no"
                    type="text"
                    class="form-control"
                    aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-lg"
                  />
                </div>
                <div class="input-group input-group-lg">
                  <span class="input-group-text" id="inputGroup-sizing-lg"
                    >第幾天</span
                  >
                  <input
                    v-model="item.pkg_howday"
                    name="pkg_howday"
                    type="text"
                    class="form-control"
                    aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-lg"
                  />
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-dismiss="modal"
                    @click="deleteAnnouncement(item, itemIndex)"
                  >
                    刪除行程景點
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-dismiss="modal"
                    @click.prevent="saveChanges(item, itemIndex)"
                  >
                    儲存變更
                  </button>
                </div>
              </li>
            <!-- </template> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- new modal -->
  <div
    class="modal fade"
    id="itemNewModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    selectFieldKey["fk1"] {{ selectFieldKey["fk1"] }}
    <br />
    selectFieldKey["fk2"] {{ selectFieldKey["fk2"] }}
    <div class="modal-dialog" style="max-width: auto">
      <div class="modal-content">
        <div class="modal-header">
          <h5 name="header">新增行程景點</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >行程編號</span
                >
                <!-- <input
                  v-model="newAnnouncement.pkg_no"
                  name="pkg_no"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                /> -->
                <!-- <div class="col-md-2"> -->
                <select
                  ref="selected1"
                  class="form-select"
                  @change="selectOption('fk1', 'selected1')"
                >
                  <option ref="select" value="0">-請選擇-</option>
                  <option
                    ref="select"
                    v-for="(item, index) in PackageData"
                    :value="index"
                  >
                    {{ ` ${index} - ${item}` }}
                  </option>
                </select>
                <!-- </div> -->
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點編號</span
                >
                <!-- <input
                  v-model="newAnnouncement.spot_no"
                  name="spot_no"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                /> -->
                <!-- <div class="col-md-2"> -->
                <select
                  ref="selected2"
                  class="form-select"
                  @change="selectOption('fk2', 'selected2')"
                >
                  <option ref="select" value="0">-請選擇-</option>
                  <option
                    ref="select"
                    v-for="(item, index) in SpotData"
                    :value="index"
                  >
                    {{ ` ${index} - ${item}` }}
                  </option>
                </select>
                <!-- </div> -->
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點排序</span
                >
                <input
                  v-model="newAnnouncement.spot_sort"
                  name="spot_sort"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >第幾天</span
                >
                <input
                  v-model="newAnnouncement.pkg_howday"
                  name="pkg_howday"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>
            </div>
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="clearAnnouncement()"
            >
              取消
            </button>
            <button class="btn btn-primary" @click="submitAnnouncement()">
              確定新增
            </button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
// * {
//   border: 1px solid #000;
// }
</style>
<script>
import axios from "axios";
import { Modal } from "bootstrap";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      PackagePassData: [],
      PackageData: [],
      SpotData: [],
      // items: [
      //   {
      //     pkg_no: 1,
      //     spot_no: "",
      //     spot_sort: 40,
      //     pkg_howday: 1
      //   },
      // ],
      // search
      searchText: "",
      selectPkg: 0,
      selectFieldKey: {
        fk1: 0,
        fk2: 0,
      },
      // selectFieldKey1: 0,
      // selectFieldKey2: 0,
      // model
      currentItem_pkg_no: null,
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,
      // new model
      newAnnouncement: {
        // pkg_no: "", // 確保 id 屬性存在
        // spot_no: "",
        // spot_sort: "",
        // pkg_howday: "",
      },
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.PackagePassData;
      }

      return this.PackagePassData.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
  },

  methods: {
    changeArray(pkg_index) {
      const filteredArray = this.PackagePassData.filter(
        (item) => item.pkg_no === pkg_index
      );
      return filteredArray.sort((a, b) => a.spot_sort - b.spot_sort);
    },
    selectPkgOption() {
      this.selectPkg = parseInt(this.$refs.selected.value);
    },
    //選擇篩選欄位
    selectOption(fk, selected) {
      this.selectFieldKey[fk] = parseInt(this.$refs[selected].value);
    },
    // edit model
    saveChanges(item, itemIndex) {
      // 在這裡更新資料
      // 如有需要，你也可以將 currentItem 傳到後端
      this.currentItem = { ...this.backupItem };
      this.showModal = false;
      //傳送資料庫的資料
      const data = new FormData(); // POST 表單資料
      data.append("pkg_no", item.pkg_no);
      data.append("spot_no", item.spot_no);
      data.append("spot_sort", item.spot_sort);
      data.append("pkg_howday", item.pkg_howday);
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}editPackagePass.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // 重新取得資料
          alert("已修改行程景點成功！");
          this.getdataFromMySQL();
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          console.log("修改失敗！");
        });
    },
    cancelChanges() {
      this.currentItem_pkg_no = null;
      this.currentItem = { ...this.backupItem };
      this.showModal = false;
    },
    openModal(item, pkg_no) {
      this.currentItem_pkg_no = pkg_no;
      this.currentItem = item;
      this.showModal = true;

      this.$nextTick(() => {
        const modalElement = document.getElementById("itemModal");
        const modalInstance = new Modal(modalElement);
        modalInstance.show();

        modalElement.addEventListener("hide.bs.modal", () => {
          this.showModal = false;
        });
      });
    },
    // new model
    submitAnnouncement() {
      console.log(!this.newAnnouncement.spot_sort);
      if (
        this.selectFieldKey["fk1"] == 0 ||
        this.selectFieldKey["fk2"] == 0 ||
        !this.newAnnouncement.spot_sort ||
        !this.newAnnouncement.pkg_howday
      ) {
        this.clearAnnouncement;
        alert("所有欄位都必須填寫！");
        return;
      }
      // 準備要傳送的資料
      const data = new FormData(); // POST 表單資料
      data.append("pkg_no", this.selectFieldKey["fk1"]);
      data.append("spot_no", this.selectFieldKey["fk2"]);
      data.append("spot_sort", this.newAnnouncement.spot_sort);
      data.append("pkg_howday", this.newAnnouncement.pkg_howday);

      console.log("data:", data);
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}postPackagePass.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // 重新取得資料
          alert("新增成功！");
          this.getPackagePassData();
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
        });
      this.clearAnnouncement();
      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.selectFieldKey["fk1"] = 0;
      this.selectFieldKey["fk2"] = 0;
      this.$refs["selected1"].value = 0;
      this.$refs["selected2"].value = 0;
      this.newAnnouncement = {
        pkg_no: "",
        spot_no: "",
        spot_sort: "",
        pkg_howday: "",
      };
    },

    // delete announcement
    deleteAnnouncement(item, itemIndex) {
      // const index = this.currentItem.findIndex(
      //   (item) => item.pkg_no === this.SpotData.spot_sort
      // );
      // if (index !== -1) {
        // this.currentItem.splice(itemIndex, 1);
        // this.showModal = false;
      // }
      //傳送資料庫要刪除的項目
      const data = new FormData(); // POST 表單資料
      data.append("pkg_no", item.pkg_no);
      data.append("spot_no", item.spot_no);
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}deletePackagePass.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // 重新取得資料
          alert("已刪除行程景點成功！");
          this.getPackagePassData();
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("刪除失敗！");
        });
    },
    //取資料
    async getPackagePassData() {
      await axios
        .get(`${BASE_URL}getPackagePass.php`)
        .then((response) => {
          this.PackagePassData = response.data;

          // 確認是否成功
          console.log("Data retrieved from MySQL:", "PackagePassData");
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
    async getPackageData() {
      await axios
        .get(`${BASE_URL}getPackage.php`)
        .then((response) => {
          // 使用 reduce 遍歷並將 pkg_no 與 pkg_name 配對添加到 PackageData
          const data = response.data;

          this.PackageData = data.reduce((allData, item) => {
            allData[item.pkg_no] = item.pkg_name;
            return allData;
          }, {});

          // console.log(`${BASE_URL}getPackage.php`);
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
    async getSpotData() {
      await axios
        .get(`${BASE_URL}getSpot.php`)
        .then((response) => {
          // 使用 reduce 遍歷並將 spot_no 與 spot_name 配對添加到 SpotData
          const data = response.data;

          this.SpotData = data.reduce((allData, item) => {
            allData[item.spot_no] = item.spot_name;
            return allData;
          }, {});
          // console.log(`${BASE_URL}getSpot.php`);
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
  },
  created() {
    this.getPackagePassData();
    this.getPackageData();
    this.getSpotData();
  },
};
</script>

<style lang="scss" scoped>
.search_new {
  display: flex;
  gap: 12px;
  margin-bottom: 12px;

  .b_new {
    white-space: nowrap;
  }
}
.ellipsis {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 80px; // 設定你希望的寬度
}
.model_body_pic {
  width: 100%;
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}

h5 {
  margin-bottom: 0;
}

.modal-footer {
  justify-content: center;
}
</style>
