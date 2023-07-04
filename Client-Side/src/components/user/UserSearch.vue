<template>
        
    
<div class="div" style="background-color:#84C7F9; height: 100%;">
    <div class="container parent" >
      <!-- search -->
      <div class="row">
        <div class="col-md-6 w" style="margin-top: 5%;">
          <div class="search">
            <div class="inputContainer">
              <input type="text" class="searchTerm" placeholder="Search..." style="border-radius: 20px; border: 2px solid #294D8B; box-shadow: 0 0.125rem 0.3125rem rgba(41, 77, 139, 1);">
              <i class="fa fa-search searchIcon"></i>
            </div>
          </div>
          
        </div>
      
        <div class="col-md-3 col-sm-5" style="margin-top: 8%;">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            <label class="form-check-label" for="flexCheckDefault" style="color: #1E56A0; font-weight: bold;">Donor Drugs</label>
          </div>
        </div>
        <div class="col-md-3 col-sm-5" style="margin-top: 8%;">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" />
            <label class="form-check-label" for="flexCheckChecked" style="color: #1E56A0; font-weight: bold;">Pharmacy Drugs</label>
          </div>
        </div>
      </div>
    <!-- donor search -->
    <div class="row" style="margin-top: 5%;">
      <div class="container1" style="justify-content: center; background-color: #ffff;">
        <div class="flex-container">
          <img src="../../../public/images/User.svg" class="donor-image">
          <span style="color: #294D8B; font-weight: bolder; font-size: x-large;">Donors</span>
        </div>
      </div>
    </div>
    
    <!-- divs  donor search -->
    
    <div v-for="drug in donorDrugs" class="row row-cols-1  g-4 row-cols-md-4" style="margin-top: 0%;">
    <!-- first col -->
    <div class="col">
      <div class="card" style="border-radius: 0%; box-shadow: 0 0.225rem 0.4125rem rgba(30, 86, 160, 0.9);">
        <img src="`${drug.img}`" class="card-img-top" alt="..." style="border-radius: 0%;">
        <div class="card-body" style="text-align: center; background-color: white; color: #1E56A0;">
          <h5 class="card-title">`${drug.name}`</h5>
          <p class="card-text">`${drug.price}` EGP</p>
        </div>
      </div>
      <button class="btn" style="text-align: center; margin-top: 2%; background-color: #1E56A0; color: #ffff; width: 100%; border-radius: 0%;">View Details</button>
    </div>
    <!-- end first col -->
    </div>
    
    
    <!-- Pharmacy search -->
    <div class="row" style="margin-top: 13%;">
      <div class="container1" style="justify-content: center; background-color: #ffff;">
        <div class="flex-container" style="align-items: center; justify-content: center;">
          <img src="../../../public/images/Pharmacy.svg" class="donor-image">
          <span style="color: #294D8B; font-weight: bolder; font-size: x-large;">Pharmacy</span>
        </div>
      </div>
    </div>
    
    
    <!-- divs  Pharmacy search -->
    
    <div  v-for="drug in pharmacyDrugs" id="pharmacydiv" class="row row-cols-1  g-4 row-cols-md-4" style="margin-top: 0%;">
    <!-- first col -->
    <div class="col">
      <div class="card" style="border-radius: 0%; box-shadow: 0 0.125rem 0.3125rem rgba(30, 86, 160, 0.9);">
        <img src="`${drug.img}`" class="card-img-top" alt="..." style="border-radius: 0%;">
        <div class="card-body" style="text-align: center; background-color: white; color: #1E56A0;">
          <h5 class="card-title">`${drug.name}`</h5>
          <p class="card-text">`${drug.price}` EGP</p>
        </div>
      </div>
      <button class="btn" style="text-align: center; margin-top: 2%; background-color: #1E56A0; color: #ffff; width: 100%; border-radius: 0%;">View Details</button>
    </div>
    
    <!-- end first col -->
    </div>
    
    
    
    <!-- buttons -->
    <!-- <div class="row" style="display: flex; justify-content: center; align-items: center; margin-top: 5%;">
      <div class="circle">
        <i class="fa-sharp fa-solid fa-arrow-left fa-xl" style="color: #fafafa;"></i>
      </div>
      <div class="circle">
        <i class="fa-solid fa-arrow-right fa-xl" style="color: #ffffff;"></i>
      </div>
    </div> -->
    
    
    </div>
    </div>



    
</template>



<script setup>
    const pharmacy = document.getElementById('pharmacydiv');
    import { ref, onMounted } from "vue";
    import axios from "axios";
    import { useRoute } from "vue-router";
    let search = "";
      async function get(){
      var searchName = document.getElementById("searchName");
      if(searchName!=null){
        search = searchName.value;
      }

      try {
      const response = await axios.get(`http://127.0.0.1:8000/api/pharmacies/drug?name=${search}`);
      const pharmacyDrugs = response.data;
      if(pharmacyDrugs != {}){
      console.log(pharmacyDrugs);}
    }
      catch{
      console.error("Error:", errors.response.data);
      }
      try {
      const response2 = await axios.get(`http://127.0.0.1:8000/api/users/drugs/${search}`);
      const donorDrugs = response2.data;
      if(donorDrugs != {}){
      console.log(donorDrugs);}
    }
      catch{
      console.error("Error:", errors.response2.data);
      }
    
    
      
    }
    
    
//     if(searchName != null){
//     searchName.addEventListener("keydown", function (e) {
//     if (e.code === "Enter") {  //checks whether the pressed key is "Enter"
//         read();
//     }
// });
//     }

  //   function read(){
  //     name=searchName.value;
  //     console.log(name)
  // }

    const price = ref('');
    const quantity = ref('');
    const drugImageInput = ref(null); 
    const errors = ref({
       name: '',
    });

    const route = useRoute();
    const drugId = ref(route.params.id); 

  //   onMounted(async () => {
  //   try {
  //   const response = await axios.get(`http://127.0.0.1:8000/api/pharmacies/drug?name=${search}`);
  //   const drug = response.data;
  //   console.log(drug);}
  //   catch{
  //     console.error("Error:", errors.response.data);
  //   }
  // })


    
</script>




<style scoped>
    .search {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 5%;
  }

  .inputContainer {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
  }

  .searchTerm {
    width: 100%;
    padding: 10px;
    border: none;
    outline: none;
    box-shadow: none;
    padding-right: 40px; /* Adjust the padding to accommodate the icon */
    position: relative;
  }

  .searchIcon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #555;
    pointer-events: none;
  }

  @media (max-width: 768px) {
    .searchTerm {
      padding-right: 30px; /* Adjust the padding to accommodate the icon on smaller screens */
    }
  }
.container1 {
    border-radius: 3rem;
    box-shadow: 0 0.225rem 0.6125rem rgba(30, 86, 160, 0.9);
    padding: 0.925rem;
    width: 15rem;
    text-align: center;
  }
  
  .flex-container {
    display: flex;
    align-items: center;
    justify-content: flex-start; 
    flex-direction: row;
  }
  
  .donor-image {
    height: 2.125rem;
  }

  .container1 {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-color: #ffff;
  }

  @media (max-width: 768px) {
    .container1 {
      width: 100%;
    }
  }

  .circle {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #294D8B;
    margin: 10px;
  }
  
  .circle i {
    color: #ffffff;
  }
  
  @media (max-width: 768px) {
    .circle {
      width: 40px;
      height: 40px;
    }
  }
  
  @media (max-width: 576px) {
    .circle {
      width: 30px;
      height: 30px;
    }
  }
  
</style>