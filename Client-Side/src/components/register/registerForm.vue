<script setup>
//Imports
import {computed, ref} from "vue";
import axios from "axios";

//Variables
let firstName=ref();
let lastName=ref();
let email=ref();
let password=ref();
let confirmPass=ref();
let mobileNumber=ref();
let photo=ref();
let samePassword=ref(true);
let validPassword=ref(true);
let validEmail=ref(true);
let validDate=ref(true);
let img=ref();


//Functions
let getValue=(event)=>{
  const files = event.target.files;
  photo.value=files[0].name;
  img.value=files[0];
};
let submit=async (event)=>{
  event.preventDefault();
  validDate.value=true;
  const emailRegex =/^[a-z][a-z0-9]*@[a-z]+\.[a-z]+$/;
  const passwordRegex =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
  if(firstName.value==undefined){
   firstName.value="";
   validDate.value=false;
 }
  if(lastName.value==undefined){
    lastName.value="";
    validDate.value=false;
  }
  if(email.value==undefined){
    email.value="";
    validDate.value=false;
  }
  if (!emailRegex.test(email.value)){
    validEmail.value=false;
    validDate.value=false;
  }else {
    validEmail.value=true;
  }
  if(password.value==undefined){
    password.value="";
    validDate.value=false;
  }
  if (!passwordRegex.test(password.value)){
    validPassword.value=false;
    validDate.value=false;
  }else {
    validPassword.value=true;
  }
  if(confirmPass.value==undefined){
    confirmPass.value="";
    validDate.value=false;
  }
  if(mobileNumber.value==undefined){
    mobileNumber.value="";
    validDate.value=false;
  }
  if(photo.value==undefined){
    photo.value="";
    validDate.value=false;
  }

  if (password.value!=confirmPass.value){
    samePassword.value=false;
    validDate.value=false;
  }
  if (password.value==confirmPass.value ){
    samePassword.value=true;
  }

  if (validDate.value){
    const formData=new FormData();
    formData.append('first_name',firstName.value);
    formData.append('last_name',lastName.value);
    formData.append('email',email.value);
    formData.append('password',password.value);
    formData.append('phone_num',mobileNumber.value);
    formData.append('img',img.value);
    try {
      const user=await axios.post("http://127.0.0.1:8000/api/user",formData);
      console.log("added");
      document.getElementById('login').click();
    }catch (e){
      console.log(e.message);
    }

  }else {
    console.log("Wrong Data");
  }
}

//Computed
const getPhoto=computed(()=>{
 return photo;
});
</script>

<template>
  <div class="back-ground container-fluid justify-content-center">
    <div class="row">
      <div class="col-4"></div>
      <div class="col"><h1 class="headlines mt-5 ms-5">Create your Account</h1></div>
    </div>

    <form @submit="submit">
    <div class="row mt-5">
      <div class="col-4"></div>
      <div class="col-6">
        <div class="form-floating">
          <input type="text" class="form-control rounded-5 w-100" id="firstName" v-model="firstName" placeholder="First Name">
          <label for="firstName" class="fw-bold normal-words w-100"><i class="fa-solid fa-user mx-3 fs-5"></i>First Name</label>
        </div>
        <span class="text-danger fw-bold" v-show="firstName==''">First Name is required</span>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-4"></div>
      <div class="col-6">
        <div class="form-floating">
          <input type="text" class="form-control rounded-5 w-100" id="lastName" v-model="lastName" placeholder="Last Name">
          <label for="lastName" class="fw-bold normal-words w-100"><i class="fa-solid fa-user mx-3 fs-5"></i>Last Name</label>
        </div>
        <span class="text-danger fw-bold" v-show="lastName==''">Last Name is required</span>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-4"></div>
      <div class="col-6">
        <div class="form-floating">
          <input type="email" class="form-control rounded-5 w-100" id="email" v-model="email" placeholder="Email">
          <label for="email" class="fw-bold normal-words w-100"><i class="fa-solid fa-envelope mx-3 fs-5"></i> Email</label>
        </div>
        <span class="text-danger fw-bold" v-show="email==''">Email is required</span> <br>
        <span class="text-danger fw-bold" v-show="!validEmail">Enter valid Email</span>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-4"></div>
      <div class="col-6">
        <div class="form-floating">
          <input type="password" class="form-control rounded-5 w-100" id="password" v-model="password" placeholder="Password">
          <label for="password" class="fw-bold normal-words w-100"><i class="fa-solid fa-lock mx-3 fs-5"></i>Password</label>
        </div>
        <span class="text-danger fw-bold" v-show="password==''">password is required</span> <br>
        <span class="text-danger fw-bold" v-show="!validPassword">Password should contain Upper and Lower character and special character and digits and should be 8 or more length</span>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-4"></div>
      <div class="col-6">
        <div class="form-floating">
          <input type="password" class="form-control rounded-5 w-100" id="confirmPassword" v-model="confirmPass" placeholder="Confirm Password">
          <label for="confirmPassword" class="fw-bold normal-words w-100"><i class="fa-solid fa-lock mx-3 fs-5"></i>Confirm Password</label>
        </div>
        <span class="text-danger fw-bold" v-show="confirmPass==''">You should confirm your password</span> <br>
        <span class="text-danger fw-bold" v-show="!samePassword">Two Passwords should be the same</span>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-4"></div>
      <div class="col-6">
        <div class="form-floating">
          <input type="text" class="form-control rounded-5 w-100" id="phoneNumber" v-model="mobileNumber" placeholder="Mobile Number">
          <label for="phoneNumber" class="fw-bold normal-words w-100"><i class="fa-solid fa-mobile-screen-button mx-3 fs-5"></i>Mobile Number</label>
        </div>
        <span class="text-danger fw-bold" v-show="mobileNumber==''">Mobile Number is required</span>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-4"></div>
      <div class="col-3">
        <div class="form-floating">
          <input type="file" hidden class="form-control rounded-5" id="profileImage" ref="ph" placeholder="Upload image" @change="getValue">
          <button type="button" class="btn button-background rounded-5"><label for="profileImage" class="fw-bold normal-words"><i class="fa-solid fa-image mx-3 fs-5"></i>Upload image</label></button>
        </div>
        <span class="text-danger fw-bold" v-show="photo==''">You should choose profile picture</span>
      </div>
      <div class="col-3">
        <p class="headlines">{{getPhoto}}</p>
      </div>
    </div>



    <div class="row mt-4">
      <div class="col-6"></div>
      <div class="col">
        <button  class="btn submit-btn">Sign Up</button>
      </div>
    </div>
    </form>
    <div class="row mt-4">
      <div class="col-5"></div>
      <div class="col">
        <p class="text-light fs-5">Already have account? <router-link to="/signin" class="headlines" id="login">Login</router-link></p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.back-ground{
  background-image: url("/images/register-background.jpeg");
  background-repeat: no-repeat;
  background-size: cover;
  font-family: 'body-font';
}
.headlines{
  color: #163172;
}
.normal-words{
  color: #00A4D6;
}
.button-background{
  background-color: white;
  color: #00A4D6;
}
@font-face {
  font-family: 'body-font';
  src: url("/fonts/MontserratAlternates-Regular.ttf") format("woff2");
  font-weight: normal;
  font-style: normal;
}
.type{
  background-color: white;
  color: #00A4D6;
}
.submit-btn{
  background-color:#163172;
  color: white;
}
</style>