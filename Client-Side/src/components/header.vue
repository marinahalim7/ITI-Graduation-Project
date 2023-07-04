<script setup>
import logo from '../assets/Logo.png'
</script>
<template>
  <nav class="navbar navbar-expand-lg" style="background-color:#163172;">
    <div class="container-fluid d-flex justify-content-evently">
      <div class="text-center mx-3">
        <a class="navbar-brand" href="#" style="padding-left: 0">
          <img
            :src="logo"
            alt="Logo"
            width="50"
            height="50"
            class="d-inline-block align-text-center"
          />
        </a>
        <div class="fs-5 bold text-light">PharmaTech</div>
      </div>
      <div class="" id="navbarNavAltMarkup">
        <slot name="route"/>
        <!-- <div class="navbar-nav">
          <router-link to="/AddDrugInStoreDrugs" class="nav-link mx-3 fs-5">Home</router-link>
          <router-link to="/AddDrugInPharmacyDrugs" class="nav-link mx-3 fs-5" >Search</router-link>
          <router-link to="/SearchForDrugs" class="nav-link mx-3 fs-5" >Sell</router-link>
          <router-link to="/AddDrugInStoreDrugs" class="nav-link mx-3 fs-5" >Sign In</router-link>
        </div> -->
      </div>
         <slot name="login"/>

      <!-- <div>
        <a class="navbar-brand" href="#" style="padding-left: 0">
          <img
            src="../assets/Logo.png"
            alt="image"
            width="50"
            height="50"
            class="d-inline-block align-text-end"
          />
        </a>
        <div class="bold text-light">mayar</div>
      </div> -->
    </div>
  </nav>
  <div class="text-center">{{ msg }}</div>
</template>


<style>
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#app {
  min-height: 100%;
  display: flex;
  flex-direction: column;
}

.content {
  flex: 1;
}
</style>