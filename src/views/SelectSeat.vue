<script>
export default {
  data() {
    return {
      name: "探尋星空之美，搭乘耀眼的七星豪華列車二日遊",
      departure: "2025/03/18 9:00",
      back: "2025/03/19 21:00",
      departureSite: "有夠站",
      backSite: "SUPER站",
      startSale: "2025-01-18 12:00",
      count: 1,
      maxCount: 6,
      price: 36888,
      pass: [
        {
          name: "綠野牧場",
        },
        {
          name: "景觀公園",
        },
        {
          name: "銀月山脈",
        },
        {
          name: "高原遺跡",
        },
        {
          name: "海底餐廳",
        },
      ],

      portion1: [
        {
          seat: [
            {
              number: "1",
              id: "A1",
              isSelected: false,
              status: "unbooked",
            },
            {
              number: "2",
              id: "A2",
              isSelected: false,
              status: "booked",
            },
          ],
        },
        {
          seat: [
            {
              number: "3",
              id: "A3",
              isSelected: false,
              status: "booked",
            },
            {
              number: "4",
              id: "A4",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
        {
          seat: [
            {
              number: "5",
              id: "A5",
              isSelected: false,
              status: "unbooked",
            },
            {
              number: "6",
              id: "A6",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
        {
          seat: [
            {
              number: "7",
              id: "A7",
              isSelected: false,
              status: "unbooked",
            },
            {
              number: "8",
              id: "A8",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
        {
          seat: [
            {
              number: "9",
              id: "A9",
              isSelected: false,
              status: "unbooked",
            },
            {
              number: "10",
              id: "A10",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
      ],

      portion2: [
        {
          seat: [
            {
              id: "B1",
              isSelected: false,
              status: "unbooked",
            },
            {
              id: "B2",
              isSelected: false,
              status: "booked",
            },
          ],
        },
        {
          seat: [
            {
              id: "B3",
              isSelected: false,
              status: "booked",
            },
            {
              id: "B4",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
        {
          seat: [
            {
              id: "B5",
              isSelected: false,
              status: "unbooked",
            },
            {
              id: "B6",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
        {
          seat: [
            {
              id: "B7",
              isSelected: false,
              status: "unbooked",
            },
            {
              id: "B8",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
        {
          seat: [
            {
              id: "B9",
              isSelected: false,
              status: "unbooked",
            },
            {
              id: "B10",
              isSelected: false,
              status: "unbooked",
            },
          ],
        },
      ],
    };
  },

  methods: {
    reduce() {
      //禁止購票數<0
      if (this.count == 1) return;
      this.count -= 1;
    },

    add() {
      //禁止購票數量>maxCount
      if (this.count === this.maxCount) return;
      this.count += 1;
    },
    //座位已經被預訂（即 status 為 "booked"），則用戶不應該能夠選擇它
    //再來判斷能夠選擇的座位數量要和count相同
    selected(item) {
      if (item.status !== "booked") {
        const selectedSeats = this.getSelectedSeats();
        if (selectedSeats.length < this.count || item.isSelected) {
          item.isSelected = !item.isSelected;
        }
      }
    },
    getSelectedSeats() {
      const allPortions = [...this.portion1, ...this.portion2];
      return allPortions.reduce((selectedSeats, group) => {
        const selectedInGroup = group.seat.filter((seat) => seat.isSelected);
        return selectedSeats.concat(selectedInGroup);
      }, []);
    },
    //-----------------------------------
    //驗證人數與座位數是否相符
    validate() {
      const selectedSeats = this.getSelectedSeats();
      if (selectedSeats.length === this.count) {
        return (selectedSeats.length = this.count);
      }
    },

    confirm() {
      if (this.validate()) {
        // 選擇有效，繼續購票流程
        alert("前往付款頁面");
      } else {
        // 選擇無效，顯示錯誤消息
        alert("人數與選擇的座位數不符合，請重新確認");
      }
    },
    //----------------------
  },
};
</script>
<template>
  <section class="title">
    <h1>一般訂票</h1>
  </section>
  <div class="container">
    <section class="info">
      <h2>行程資訊</h2>

      <div class="info-list">
        <p>出發時間：{{ departure }}</p>
        <p>回程時間：{{ back }}</p>
        <!-- <p>起程站：{{ departureSite }}</p> -->
        <!-- <p>終點站：{{ backSite }}</p> -->
        <div class="pass">
          <h3>途經景點:</h3>
          <div class="wrap">
            <p v-for="(item, index) in pass" :key="index">
              {{ item.name }}
            </p>
          </div>
        </div>
        <p>※本列車行程為包含來回</p>
        <p>販售時間：{{ startSale }}，售完為止</p>
        <p>取票方式：現場取票</p>
        <p>票價：{{ price }}</p>
      </div>
    </section>

    <section class="choose">
      <h2>座位選擇</h2>

      <div class="choose-option">
        <div class="select-car">
          <label for="">車廂選擇：</label>
          <select class="select" name="car">
            <option value="">--請選擇車廂--</option>
            <option value="car1">第一車廂</option>
            <option value="car2">第二車廂</option>
          </select>
        </div>
        <div class="count">
          <div>人數選擇：</div>
          <button class="minus" @click="reduce">
            <i class="fa-solid fa-minus"></i>
          </button>
          <input type="tel" v-model="count" readonly />
          <button class="plus" @click="add">
            <i class="fa-solid fa-plus"></i>
          </button>
        </div>
      </div>
    </section>

    <section class="seat-pic">
      <div class="whole">
        <div class="seat-area">
          <div class="portion1" v-for="(group, index) in portion1" :key="group">
            <div
              class="seat"
              :class="[
                { selected: item.isSelected },
                item.status === 'booked' ? 'booked' : 'unbooked',
              ]"
              v-for="(item, seatIndex) in group.seat"
              :key="seatIndex"
              @click="selected(item)"
            >
              <div class="num">{{ item.number }}</div>
            </div>
          </div>

          <div class="portion2" v-for="(group, index) in portion2" :key="group">
            <div
              class="seat"
              :class="[
                { selected: item.isSelected },
                item.status === 'booked' ? 'booked' : 'unbooked',
              ]"
              v-for="(item, seatIndex) in group.seat"
              :key="seatIndex"
              @click="selected(item)"
            ></div>
          </div>

          <div class="A">A</div>
          <div class="B">B</div>
        </div>
      </div>

      <div class="seat-color">
        <div class="item">
          <div class="booked"></div>
          <div class="inner">已售出的座位</div>
        </div>
        <div class="item">
          <div class="empty"></div>
          <div class="inner">可選擇的座位</div>
        </div>
        <div class="item">
          <div class="select"></div>
          <div class="inner">選擇的座位</div>
        </div>
      </div>
    </section>

    <section class="total">
      <p>
        總計：<span>{{ price * count }}</span>
      </p>
    </section>

    <section class="next-step">
      <div class="btn secondary">
        <router-link to="">
          <span>返回</span>
        </router-link>
      </div>

      <div class="btn primary" @click="confirm">
        <router-link to="/custom-tickets">
          <span>確認購票</span>
        </router-link>
      </div>
    </section>
  </div>
</template>

<style lang="scss" scoped>
@import "@/assets/scss/style.scss";

* {
  box-sizing: border-box;
}
.container {
  @include layout(1200);
}

section.title {
  text-align: center;
  background-color: white;
  h1 {
    font-size: 2rem;
    padding: 1.25rem;
  }
}

section.info {
  h2 {
    font-size: 1.5rem;
    padding: 1.25rem 0;
    border-bottom: 2px dotted #333;
  }

  p {
    font-size: 1.25rem;
    padding: 0.25rem 0;
  }

  .info-list {
    padding: 1.25rem 0;
    .pass {
      margin-top: 1.75rem;
      h3 {
        font-size: 1.25rem;
      }

      .wrap {
        display: flex;
        p {
          padding-right: 1rem;
        }
      }
    }
  }
}

section.choose {
  h2 {
    font-size: 1.5rem;
    padding: 1.25rem 0;
    border-bottom: 2px dotted #333;
  }

  .choose-option {
    padding: 1.5rem;
    display: flex;
    justify-content: center;

    .select-car {
      margin-right: 2rem;
      label {
        font-size: 1.25rem;
        font-weight: bold;
        margin-right: 0.25rem;
      }

      select {
        width: 160px;
        height: 40px;
        font-family: $fontFamily;

        font-size: 1.1rem;
        font-weight: bold;
        // line-height: 40px;
        border-radius: 5px;
        outline-style: none;
        option {
          font-family: $fontFamily;
          font-weight: bold;
          font-size: 1.1rem;
        }
      }
    }
    .count {
      display: flex;
      font-size: 1.25rem;
      font-weight: bold;
      align-items: center;
      .minus {
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 5px 0 0 5px;
        background-color: #fff;
      }
      .plus {
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 0 5px 5px 0;
        background-color: #fff;
      }

      input {
        width: 100px;
        height: 30px;
        text-align: center;
        outline-style: none;
      }
    }
  }
}

section.seat-pic {
  margin: 2.5rem 0;
  border-bottom: 1px solid #333;

  .whole {
    width: 100%;
    height: 300px;
    border-radius: 125px;
    background-color: #9ca3af;
    border: 4px solid #333;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    .seat-area {
      width: 80%;
      height: 300px;
      display: grid;
      margin: auto;
      grid-template-columns: repeat(5, 1fr);
      row-gap: 75px;
      column-gap: 50px;
      position: relative;
      .portion1 {
        display: flex;
        justify-content: center;
        .seat {
          position: relative;
          cursor: pointer;
          width: 50px;
          height: 65px;
          margin: 0.5rem;

          &.booked {
            background-color: #4b5563;
          }
          &.unbooked {
            background-color: #fff;

            &.selected {
              background-color: $hoverColor;
            }
          }

          .num {
            font-size: 1.25rem;
            font-weight: bold;
            position: absolute;
            bottom: 110%;
            left: 35%;
          }
        }
      }
      .portion2 {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        .seat {
          cursor: pointer;
          width: 50px;
          height: 65px;
          margin: 0.5rem;

          &.booked {
            background-color: #4b5563;
          }

          &.unbooked {
            background-color: #fff;

            &.selected {
              background-color: $hoverColor;
            }
          }
        }
      }

      .A {
        font-size: 1.25rem;
        font-weight: bold;
        position: absolute;
        top: 5%;
        right: 101%;
      }

      .B {
        font-size: 1.25rem;
        font-weight: bold;
        position: absolute;
        bottom: 5%;
        right: 101%;
      }
    }
  }

  .seat-color {
    margin: 2.5rem 0;
    display: flex;
    .item {
      display: flex;
      align-items: center;
      .booked {
        width: 50px;
        height: 50px;
        background-color: #4b5563;
        margin: 0 2rem;
      }
      .empty {
        width: 50px;
        height: 50px;
        background-color: #fff;
        border: 1px solid #333;
        margin: 0 2rem;
      }

      .select {
        width: 50px;
        height: 50px;
        background-color: $hoverColor;
        margin: 0 2rem;
      }

      .inner {
        font-size: 1.25rem;
        font-weight: bold;
      }
    }
  }
}

section.total {
  text-align: end;
  font-weight: bold;
  // padding: 1.25rem 0;
  P {
    font-size: 1.75rem;
  }
  span {
    font-size: 2rem;
  }
}

section.next-step {
  display: flex;
  justify-content: center;
  margin: 6rem 0 3rem 0;

  .btn {
    display: inline-block;
    width: 200px;
    border-radius: 7.5px;
    margin: 0 2rem;
    cursor: pointer;

    span {
      line-height: 50px;
      height: 50px;
      font-size: 1.5rem;
      color: #fff;
    }
  }
}

@media screen and (max-width: 768px) {
  .container {
    padding: 0 1.5rem;
  }

  section.choose {
    .choose-option {
      padding: 1.5rem;
      display: flex;
      justify-content: flex-start;
    }
  }

  section.seat-pic {
    margin: 0.5rem 0;

    height: 1225px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    // position: relative;
    // aspect-ratio: 3/1;
    .whole {
      transform-origin: top left;
      transform: rotate(90deg) translateY(-450px);
      width: 1100px;
      // position: absolute;
      // top: 0;
      // left: 0;
      .seat-area {
        .num {
          transform: rotate(-90deg);
        }
        .A {
          transform: rotate(-90deg);
        }

        .B {
          transform: rotate(-90deg);
        }
      }
    }
  }

  section.next-step {
    margin: 3rem 0;
  }
}
</style>
