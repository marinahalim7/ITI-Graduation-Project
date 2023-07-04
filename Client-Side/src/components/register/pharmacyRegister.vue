<script setup>
//Imports
import {ref} from "vue";
import axios from "axios";

//Variables
let pharmacyName=ref();
let password = ref();
let ownerSSN = ref();
let mobileNumber = ref();
let long= ref();
let lat = ref();
let validPassword=ref(true);
let validDate=ref(true);

//Functions
let submit=async (event)=>{
  event.preventDefault();
  validDate.value=true;
  const passwordRegex =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
  if(pharmacyName.value==undefined){
    pharmacyName.value="";
    validDate.value=false;
  }
  if(password.value==undefined){
    password.value="";
    validDate.value=false;
  }
  if(ownerSSN.value==undefined){
    ownerSSN.value="";
    validDate.value=false;
  }
  if(mobileNumber.value==undefined){
    mobileNumber.value="";
    validDate.value=false;
  }
  if(long.value==undefined){
    long.value="";
    validDate.value=false;
  }
  if(lat.value==undefined){
    lat.value="";
    validDate.value=false;
  }
  if (!passwordRegex.test(password.value)){
    validPassword.value=false;
    validDate.value=false;
  }else {
    validPassword.value=true;
  }
  if (validDate.value){
    const formData=new FormData();
    formData.append('name',name.value);
    formData.append('password',password.value);
    formData.append('owner_SSN',ownerSSN.value);
    formData.append('phone_num',mobileNumber.value);
    formData.append('location_lat',lat.value);
    formData.append('location_long',long.value);
    try {
      const pharmacy=await axios.post("http://127.0.0.1:8000/api/pharmacy",formData);
      console.log("added");
      document.getElementById('login').click();
    }catch (e){
      console.log(e.message);
    }

  }else {
    console.log("Wrong Data");
  }
}
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
            <input type="text" class="form-control rounded-5 w-100" id="name" v-model="pharmacyName" placeholder="Pharmacy Name">
            <label for="name" class="fw-bold normal-words w-100"><i class="fa-solid fa-mortar-pestle mx-3 fs-5"></i>Pharmacy Name</label>
          </div>
          <span class="text-danger fw-bold" v-show="pharmacyName==''">Pharmacy Name is required</span>
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
            <input type="text" class="form-control rounded-5 w-100" id="ownerSSN" v-model="ownerSSN" placeholder="Owner SSN">
            <label for="ownerSSN" class="fw-bold normal-words w-100"><i class="fa-solid fa-id-card mx-3 fs-5"></i>Owner SSN</label>
          </div>
          <span class="text-danger fw-bold" v-show="ownerSSN==''">SSN is required</span>
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
        <div class="col-6">
          <div class="form-floating">
            <input type="number" step=".1" class="form-control rounded-5 w-100" id="long" v-model="long" placeholder="Location Longtiude">
            <label for="long" class="fw-bold normal-words w-100"><i class="fa-solid fa-location-dot mx-3 fs-5"></i> Location Longitude</label>
          </div>
          <span class="text-danger fw-bold" v-show="long==''">You should Enter your Location</span>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-4"></div>
        <div class="col-6">
          <div class="form-floating">
            <input type="number" step=".1" class="form-control rounded-5 w-100" id="lat" v-model="lat" placeholder="Location Latitude">
            <label for="lat" class="fw-bold normal-words w-100"><i class="fa-solid fa-location-dot mx-3 fs-5"></i>Location Longitude</label>
          </div>
          <span class="text-danger fw-bold" v-show="lat==''">You should Enter your Location</span>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-6"></div>
        <div class="col">
          <button  class="btn submit-btn">Sign Up</button>
        </div>
      </div>
    </form>
  </div>

  <router-link to="/payment" class="headlines" hidden id="login">Login</router-link>
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
.submit-btn{
  background-color:#163172;
  color: white;
}
</style>