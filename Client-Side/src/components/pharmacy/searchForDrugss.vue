<template>

  <navbar>
    <template v-slot:route>
      <router-link to="/" class="nav-link mx-3 fs-5">Home</router-link>
       <!-- <router-link to="/AddDrugInPharmacyDrugs" class="nav-link mx-3 fs-5" >Search</router-link> -->
    </template>
  </navbar>

  <div class="container my-3">
    <div class="row md-4">
      <div class="col-lg-4 my-3 mx-3 d-flex justify-content-center">
        <!-- <div class="flex-wrap "> -->
        <div
          v-for="product in products"
          :key="product.id"
          class="card"
          style="width: 18rem"
        >
          <div class="rounded">
            <img
              :src="`http://127.0.0.1:8000/images/storeDrug/${product.img}`"
              class="card-img-top"
              alt="..."
            />
          </div>
          <div class="card-body">
            <h4 class="card-title text-center">{{ product.name }}</h4>
            <h5 class="card-title"></h5>
            <hr />
            <div class="d-flex justify-content-between">
              <h6>Price: {{ product.price }}</h6>
              &nbsp;&nbsp; &nbsp; | &nbsp;
              <h6 class="mx-2">quantity: {{ product.quantity }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="rounded-pill bg-danger mx-5 ">
      <h3 class="text-center">You can get your order from</h3>
    </div>
<!-- ###################################33 -->


    
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import navbar from '../header.vue';

    const products = ref([]);

    const storeId = ref(7);
    // const name = ref("");
    // const price = ref(0);
    // const quantity = ref(0);
    // const image = ref("");

    onMounted(async () => {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/stores/${storeId.value}/drugs`
        );
        products.value = response.data;
        console.log(products.value);
        console.log("ddd");
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    });

    return {
      products,
    };
</script>

<style>
</style>