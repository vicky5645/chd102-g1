<template>
  <div class="settings">
    <h1 class="h4">帳號設定</h1>
    <hr>
    <div class="user-control-content">
      <div class="input-wrap">
        <label for="name" class="caption">姓名</label>
        <input type="text" id="name">
      </div>
      <div class="input-wrap">
        <label for="gender" class="caption">性別</label>
        <select id="gender-options" v-model="model">
          <option disabled checked>-請選擇-</option>
          <option v-for="item in gender" :value="item.value">{{ item.value }}</option>
        </select>
      </div>
      <div class="input-wrap">
        <label for="birthdate" class="caption">出生日期</label>
        <input type="date" id="birthdate">
      </div>
      <div class="input-wrap">
        <label for="phone" class="caption">電話號碼</label>
        <input type="tel" id="phone">
      </div>
      <div class="input-wrap long">
        <label for="email" class="caption" required>聯絡 E-mail(必填)</label>
        <input type="email" id="email">
      </div>
    </div>
    <div class="right">
      <button type="submit" class="btn disable radius">儲存</button>
    </div>
    <hr>
    <h4>帳號安全</h4>
    <div class="left">
      <button class="btn error radius">刪除帳號</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      model: '-請選擇-',
      gender: [
        {
          value: '男性',
          label: '男性'
        },
        {
          value: '女性',
          label: '女性'
        },
      ],
    }
  }
}
</script>

<style lang="scss" scoped></style>