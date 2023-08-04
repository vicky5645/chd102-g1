<!-- <template>
    <div class="card-form">
          <div class="card-input">
            <label for="" class="cardNumber">信用卡卡號</label>
            <input type="number" id="cardNumber">
          </div> 
          <div class="card-input">
            <label for="" class="cardHolder">持卡人姓名</label>
            <input type="text" id="cardHolder">
          </div>
    </div>
</template> -->
<template>
    <div>
      <label for="cardNumber">信用卡卡號</label>
      <input v-model="cardNumber" id="cardNumber" type="text" @input="validateCardNumber" />
      <span v-if="!isCardNumberValid">請輸入有效的VISA或MasterCard卡號</span>
  
      <label for="cardHolder">持卡人姓名</label>
      <input v-model="cardHolder" id="cardHolder" type="text" />
  
      <label for="expiryMonth">到期月份</label>
      <input v-model="expiryMonth" id="expiryMonth" type="text" />
  
      <label for="expiryYear">年份(西元)</label>
      <input v-model="expiryYear" id="expiryYear" type="text" />
  
      <label for="cvv">CVV</label>
      <input v-model="cvv" id="cvv" type="text" />
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        cardNumber: '',
        cardHolder: '',
        expiryMonth: '',
        expiryYear: '',
        cvv: '',
        isCardNumberValid: true,
      };
    },
    methods: {
      validateCardNumber() {
        // 簡單示範：驗證卡號是否是VISA或MasterCard
        const visaRegex = /^4[0-9]{12}(?:[0-9]{3})?$/;
        const mastercardRegex = /^5[1-5][0-9]{14}$/;
        this.isCardNumberValid = visaRegex.test(this.cardNumber) || mastercardRegex.test(this.cardNumber);
      },
    },
  };
  </script>