<template>
  <div class="login-wrap">
    <section
      class="login"
      v-if="!isRegistered && !loginStatus && !forgetPsw && step === 0"
    >
      <div class="loin-form-wrap">
        <div class="loin-form-img"></div>

        <div class="login-form">
          <div class="login-test">
            <!-- <img src="~@/assets/logo.svg" alt="logo" /> -->

            <p>登入</p>

            <span>隨時收到獨家優惠</span>
          </div>

          <form>
            <button v-for="btn in btns" class="login-connect" @click.prevent="">
              <i :class="btn.iconClass"></i> {{ btn.text }}
            </button>

            <span>或</span>

            <div class="input-wrap login">
              <input v-model="username" type="text" placeholder="" required />
              <label>帳號</label>
            </div>
            <div class="input-wrap login">
              <input v-model="password" type="text" placeholder="" required />
              <label>密碼</label>
            </div>

            <div class="error-message">{{ errorMsg }}</div>

            <div class="forget-password" @click="forgetPassword">忘記密碼?</div>

            <div class="actions">
              <span>還未加入LOGO嗎？</span>

              <button
                @click.prevent="changeRegister"
                class="login-form-register"
              >
                立即註冊！
              </button>

              <button
                class="login-form-confirm btn2"
                @click.prevent="checkLogin"
              >
                確定
              </button>
            </div>
          </form>
        </div>
        <div class="login-wrap-pic">
          <img src="/images/logo/logoBig.png" alt="Logo" />
        </div>
      </div>
    </section>

    <section class="login" v-if="isRegistered">
      <form action="">
        <div class="loin-form-wrap">
          <div class="login-form">
            <div class="login-test">
              <p>註冊會員</p>

              <span>立即登入，隨時找到獨家優惠</span>
            </div>
            <form action="">
              <button
                v-for="btn in btnsRegister"
                class="login-connect"
                @click.prevent=""
              >
                <i :class="btn.iconClass"></i> {{ btn.text }}
              </button>

              <div class="row register-label">
                <div class="col">
                  <div class="inputBox">
                    <span>名字</span>
                    <input
                      type="text"
                      class="payment-name-input"
                      required="required"
                      v-model="nameReg"
                      placeholder=""
                    />
                    <div class="payment-name"></div>
                  </div>
                  <div class="inputBox">
                    <span>信箱</span>
                    <input
                      type="email"
                      class="payment-email-input"
                      v-model="emailReg"
                      required="required"
                    />
                    <div class="payment-email"></div>
                  </div>
                  <div class="inputBox">
                    <span>密碼</span>
                    <input
                      type="text"
                      class="payment-address-input"
                      v-model="pswReg"
                      required="required"
                    />
                    <div class="payment-address"></div>
                  </div>
                  <div class="inputBox">
                    <span>再次輸入密碼</span>
                    <input
                      type="text"
                      class="payment-nation-input"
                      required="required"
                      v-model="pswConfirmReg"
                    />
                    <div class="payment-nation"></div>
                  </div>
                </div>
              </div>

              <div class="register-form-bottom">
                <div class="register-form-bottom-agree">
                  <input
                    type="checkbox"
                    name="membership"
                    id="membership"
                    required="required"
                  />
                  <label for="membership">
                    我已詳閱並同意<a href="" target="_blank">會員條款</a>與
                    <a href="" target="_blank">隱私權規定</a>
                  </label>
                </div>

                <input
                  class="register-submit"
                  @click="columnCheck"
                  type="submit"
                  value="註冊會員"
                />
              </div>
            </form>
          </div>
          <div class="login-wrap-pic">
            <img src="/images/logo/logoBig.png" alt="Logo" />
          </div>
        </div>
      </form>
    </section>

    <section class="forget_password" v-if="forgetPsw && step === 1">
      <form action="">
        <h2>忘記密碼</h2>

        <p>輸入註冊信箱，傳送驗證碼</p>
        <div class="forget-password-enter">
          <input
            type="email"
            placeholder=" 電子郵件地址 "
            v-model="memEmail"
            required="required"
          />
        </div>
        <input
          @click="checkEmail"
          type="submit"
          value="傳送"
          class="forget-password-submit"
        />
      </form>
    </section>

    <section class="enter-valid" v-if="forgetPsw && step === 2">
      <form action="">
        <h2>輸入驗證碼</h2>
        <p>已發送驗證碼至sm********@gmail.com</p>
        <div class="enter-valid-input">
          <input
            type="text"
            required="required"
            v-model="number1"
            max-length="1"
          />
          <input
            type="text"
            required="required"
            v-model="number2"
            max-length="1"
          />
          <input
            type="text"
            required="required"
            v-model="number3"
            max-length="1"
          />
          <input
            type="text"
            required="required"
            v-model="number4"
            max-length="1"
          />
        </div>

        <div class="enter-valid-re">
          <p>10 分鐘內若未收到驗證碼</p>
          <p>請<a href="">按此</a>重新發送</p>
        </div>

        <input
          @click="validCheck"
          type="submit"
          value="送出"
          class="enter-valid-submit"
        />
      </form>
    </section>

    <section class="enter-modify" v-if="forgetPsw && step === 3">
      <form action="">
        <h2>修改密碼</h2>
        <p>請輸入 6 -12 位包含英文及數字的密碼</p>

        <div class="enter-modify-input">
          <label for="modifyPsw">新密碼</label>
          <input
            type="text"
            required="required"
            v-model="modify.psw"
            maxlength="12"
            minlength="6"
            id="modifyPsw"
          />
          <label for="modifyNewPsw">再次輸入新密碼</label>

          <input
            type="text"
            required="required"
            v-model="modify.newPsw"
            maxlength="12"
            minlength="6"
            id="modifyNewPsw"
          />

          <input
            @click="modifyCheck"
            type="submit"
            value="送出"
            class="enter-modify-submit"
          />
        </div>
      </form>
    </section>

    <section class="enter-modify-success" v-if="forgetPsw && step === 4">
      <p>修改完成！</p>
      <p>請重新登入</p>
      <button @click="modifySuccess">返回會員登入</button>
    </section>

    <section class="enter-modify-success" v-if="step === 5">
      <p>🚀 註冊完成 🎉</p>
      <p>🚂 請重新登入 ↩️</p>
      <button @click="registerSuccess">返回會員登入</button>
    </section>
  </div>
</template>
<style></style>
<script>
export default {
  name: "login",
  data() {
    return {
      account: "",
      memPsw: "",
      loginStatus: false,
      isRegistered: false,
      forgetPsw: false,
      step: 0,
      errorMsg: "",
      register: {
        nameReg: "",
        emailReg: "",
        pswReg: "",
        pswConfirmReg: "",
        sexReg: "",
        birthReg: "",
        telReg: "",
      },
      verification: {
        number1: "",
        number2: "",
        number3: "",
        number4: "",
      },
      memEmail: "",
      modify: {
        psw: "",
        newPsw: "",
      },
      btns: [
        {
          text: "使用Google帳戶繼續操作",
          // pic: require('@/assets/images/login/google.svg')
          iconClass: "fab fa-google",
        },
      ],

      btnsRegister: [
        {
          text: "使用Google帳戶註冊",
          // pic: require('@/assets/images/login/google.svg')
          iconClass: "fab fa-google",
        },
      ],
    };
  },

  methods: {
    closeModal() {
      this.$emit("emit-status");
    },
    checkLogin() {
      if (this.account === "test" && this.memPsw === "test") {
        window.alert("登入成功");
        loginStatus = true;
      } else {
        this.errorMsg = "帳號或密碼輸入錯誤";
      }
      this.register.account = "";
      this.register.memPsw = "";
    },
    reset() {
      this.register.errorMsg = "";
    },
    changeRegister() {
      this.isRegistered = true;
    },
    columnCheck() {
      if (this.register.pswReg === this.register.pswConfirmReg) {
        this.isRegistered = false;
        this.step = 5;
      }
    },
    forgetPassword() {
      this.forgetPsw = true;
      this.step = 1;
    },

    checkEmail() {
      if (!this.memEmail) {
        return alert("輸入錯誤或無輸入");
      } else {
        this.step = 2;
        this.memEmail = "";
      }
    },
    validCheck() {
      if (!this.number1 || !this.number2 || !this.number3 || !this.number4) {
        alert("請輸入驗證碼");
      } else {
        this.number1 = this.number2 = this.number3 = this.number4 = "";
        this.step = 3;
      }
    },
    modifyCheck() {
      if (!this.modify.psw || !this.modify.newPsw) {
        alert("請輸入密碼");
        return;
      } else if (
        this.modify.psw === this.modify.newPsw &&
        this.modify.psw.length >= 6 &&
        this.modify.psw.length <= 12
      ) {
        this.step = 4;
        this.modify.psw = this.modify.newPsw = "";
        return;
      } else {
        alert("請輸入密碼");
      }

      this.modify.psw = "";
      this.modify.newPsw = "";
    },
    modifySuccess() {
      this.forgetPsw = false;
      this.step = 0;
    },
    registerSuccess() {
      this.step = 0;
    },
  },
};
</script>
