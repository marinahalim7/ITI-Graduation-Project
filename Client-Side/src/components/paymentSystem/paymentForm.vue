<script setup>
import {ref} from "vue";
import axios from "axios";

let visaNum=ref();
let secCode=ref();
let expDate=ref();
let pharmacy_or_store_name=ref();
let validData=ref();
let validVisaNum=ref(true);

let pay=async () => {
  const emailRegex =/^[a-z][a-z0-9]*@[a-z]+\.[a-z]+$/;
  validData.value=true;
  if (visaNum.value==undefined){
    visaNum.value='';
    validData.value=false;
  }
  if (secCode.value==undefined){
    secCode.value='';
    validData.value=false;
  }
  if (expDate.value==undefined){
    expDate.value='';
    validData.value=false;
  }
  if (pharmacy_or_store_name.value==undefined){
    pharmacy_or_store_name.value='';
    validData.value=false;
  }
if (visaNum.value.length<16 ||visaNum.value.length>16){
  validData.value=false;
  validVisaNum.value=false;
}
if (expDate.value<2023){
  validData.value=false;
  validVisaNum.value=false;
}
if (secCode.value.length<3||secCode.value.length>3){
  validData.value=false;
  validVisaNum=false;
}
  if (validData.value){
    try {
      const payment=await axios.post("http://127.0.0.1:8000/api/payment",{
        "stripeToken": "tok_visa",
        "amount": "15000",
        "currency": "usd",
        "description": "Add Store or Pharmacy",
        "name": pharmacy_or_store_name.value,
        "source": "tok_1NItroCRsB4m69RX96n82fyC"
      });
      console.log("paid");
      document.getElementById("sign").click();
    }catch (e){
      console.log(e);
    }
  }else {
    console.log("Wrong data")
  }
};

</script>

<template>
  <div class="background-container">
    <div class="content-container">
      <span class="text-danger fw-bold" v-show="!validVisaNum">Invalid Visa</span>
      <h1 class="headlines fw-bold font-bigger"><i class="fa-brands fa-cc-visa"></i> <i class="fa-brands fa-cc-mastercard fw-bold"></i> <i class="fa-brands fa-cc-stripe fw-bold"></i></h1>
      <div class="form-container">
        <p class="fw-bold mb-3" style="color: #163172">As you choose Pharmacy or Store You should pay 150 EGP per month <br> If you are agree please fill this information</p>
        <div class="form-floating">
          <input type="text" class="form-control rounded-5" id="visaNum" v-model="visaNum" placeholder="Visa Number">
          <label for="visaNum" class="fw-bold normal-words"><i class="fa-solid fa-credit-card mx-3 fs-5"></i>Visa Number</label>
        </div>
        <span class="text-danger fw-bold" v-show="visaNum==''">Please enter Visa Card Number</span>
        <div class="form-floating mt-2">
          <input type="text" class="form-control rounded-5" id="secureCode" v-model="secCode" placeholder="Security Code">
          <label for="secureCode" class="fw-bold normal-words"><i class="fa-solid fa-id-card mx-3 fs-5"></i>Security Code</label>
        </div>
        <span class="text-danger fw-bold" v-show="secCode==''">Enter code Behind your Card</span>

        <select class="form-select mt-3 rounded-5 normal-words" aria-label="Default select example">
          <option selected hidden>Expired Month</option>
          <option value="1">Jan</option>
          <option value="2">Feb</option>
          <option value="3">Mar</option>
          <option value="4">Apr</option>
          <option value="5">May</option>
          <option value="5">Jun</option>
          <option value="7">Jul</option>
          <option value="8">Aug</option>
          <option value="9">Sep</option>
          <option value="10">Oct</option>
          <option value="11">Nov</option>
          <option value="12">Dec</option>
        </select>
        <div class="form-floating mt-2">
          <input type="number" step="1" min="1900" maxlength="3000" class="form-control rounded-5" id="expDate" v-model="expDate" placeholder="Expired Year">
          <label for="expDate" class="fw-bold normal-words"><i class="fa-regular fa-calendar-days mx-3 fs-5"></i>Expired Year</label>
        </div>
        <span class="text-danger fw-bold" v-show="expDate==''">Enter Expired Date</span>
        <div class="form-floating mt-2">
          <input type="text" class="form-control rounded-5" id="name" v-model="pharmacy_or_store_name" placeholder="Your Pharmacy or Store Name">
          <label for="name" class="fw-bold normal-words">Your Pharmacy or Store Name</label>
        </div>
        <span class="text-danger fw-bold" v-show="pharmacy_or_store_name==''">Enter Your Organization Name</span>
        <button type="button" class="btn mt-2 login-btn" @click="pay()">Pay</button>
        <router-link to="/signin" hidden id="sign"></router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.background-container {
  background-image: url("/images/register-background.jpeg");
  background-repeat: no-repeat;
  background-size: cover;
  font-family: 'body-font';
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
@font-face {
  font-family: 'body-font';
  src: url("/fonts/MontserratAlternates-Regular.ttf") format("woff2");
  font-weight: normal;
  font-style: normal;
}
.login-btn{
  background-color:#163172;
  color: white;
}
.content-container {
  text-align: center;
  color: #163172;
}

.headlines {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.normal-words {
  color: #00A4D6;
}

.form-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 2rem;
}

.form-floating {
  width: 100%;
}

.form-control {
  width: 100%;
}

.rounded-5 {
  border-radius: 0.5rem;
}

.fa-solid {
  vertical-align: middle;
}
.font-bigger{
  font-size: 500px;
}
@media (min-width: 576px) {
  .headlines {
    font-size: 3rem;
  }
}
</style>
