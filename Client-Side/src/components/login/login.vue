<script setup>
//Imports
import {ref} from "vue";
import axios from "axios";

//Variables
let email=ref();
let password=ref();
let validData=ref(true);
let massage=ref();

//Functions
let login=async()=>{
  const emailRegex =/^[a-z][a-z0-9]*@[a-z]+\.[a-z]+$/;
  validData.value=true;
  if (email.value==undefined){
    email.value='';
    validData.value=false;
  }
  // if (!emailRegex.test(email.value)){
  //   validData.value=false;
  // }
  if (password.value==undefined){
    password.value='';
    validData.value=false;
  }
  if (validData.value){
    massage.value='';
    const user={
      slug: email,
      password: password
    }
    try {
      const response=await axios.post('https://localhost:8000/api/pharmacy/login',user);
      console.log(response);
    }catch (e){
      console.log(e.message);
      massage.value=e.message;
    }
  }else{
    massage.value='invalid email or password';
  }
};
</script>

<template>
  <div class="background-container">
    <div class="content-container">
      <h1 class="headlines">Welcome to<br>PharmaTech</h1>
      <div class="form-container">
        <span class="text-danger fw-bold mb-3">{{massage}}</span>
        <div class="form-floating">
          <input type="email" class="form-control rounded-5" id="email" v-model="email" placeholder="Email">
          <label for="email" class="fw-bold normal-words"><i class="fa-solid fa-envelope mx-3 fs-5"></i>Email</label>
        </div>
        <span class="text-danger fw-bold" v-show="email==''">Please enter email you want to login with</span>
        <div class="form-floating mt-2">
          <input type="password" class="form-control rounded-5" id="password" v-model="password" placeholder="Password">
          <label for="password" class="fw-bold normal-words"><i class="fa-solid fa-lock mx-3 fs-5"></i>Password</label>
        </div>
        <span class="text-danger fw-bold" v-show="password==''">Your password is required to login</span>
        <button type="button" class="btn mt-2 login-btn" @click="login()">Sign in</button>
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

@media (min-width: 576px) {
  .headlines {
    font-size: 3rem;
  }
}
</style>
