<script setup>
import { ref, onMounted,computed } from 'vue';
import { userDrugsStore } from '@/stores/user-drug';
import axios from 'axios';
import navbar from '../header.vue';


const userDrugs = userDrugsStore();
const drugs = ref([]);
const currentPage = ref(1);
const itemsPerPage = 5;

onMounted(async () => {
    await userDrugs.fetchAllDrugs();
    drugs.value = userDrugs.drugs;
    console.log('drugs:', drugs.value);
});

async function deleteDrug(id) {
    try {
        const response = await axios.delete(`http://127.0.0.1:8000/api/user/drugs/${id}`);
        this.drugs.splice(this.drugs.findIndex(drug => drug.id == id), 1);
    } catch (error) {
        console.error(error);
    }

}
const paginatedDrugs = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    return drugs.value.slice(startIndex, endIndex);
});

const totalPages = computed(() => Math.ceil(drugs.value.length / itemsPerPage));

function previousPage() {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
}

function nextPage() {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
}

//  async getname()
//  {
//     const userData = await JSON.parse(sessionStorage.getItem('user'));
//   const userName = userData.first_name;

//   return userName;


// //  const userData = JSON.parse(sessionStorage.getItem('user'));
// //   const userName = userData.first_name;

// }

const userData = JSON.parse(sessionStorage.getItem('user'));
 const userName = userData.first_name;
 const userImg = userData.img;
    console.log("ffff");
    console.log(userImg);
console.log(`http://127.0.0.1:8000/images/users/${userImg}`)



</script>

<template>

 <navbar>
    <template v-slot:route>
      <div class="d-flex text-light">
      <router-link to="/user/home" class="nav-link mx-3 fs-5">Home</router-link>
       <router-link to="/user/search" class="nav-link mx-3 fs-5" >Search</router-link>
       <router-link to="/User/AddDrug" class="nav-link mx-3 fs-5" >Sell Medicine</router-link>
       <router-link to="/" class="nav-link mx-3 fs-5"  >Log Out</router-link>
      </div>
    </template>

    <template v-slot:login>
     <div>
        <a class="navbar-brand" href="#" style="padding-left: 0">
          <img
            :src="`http://127.0.0.1:8000/images/users/${userImg}`"
            alt="image"
            width="50"
            height="50"
            class="d-inline-block align-text-end"
          />
        </a>
        <div class="bold text-light">{{userName}}</div>
      </div>

    </template>
  </navbar>



    <div class="backgroundImage">
        <div class="button-container">
            <router-link class="btn btn-primary addbutton" to="/User/AddDrug">Add Drug</router-link>
        </div>
        <div class="container">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Img</th>
                            <th scope="col">exp_img</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="drug in paginatedDrugs" :key="drug.id">
                            <td>{{ drug.name }}</td>
                            <td>
                                <img :src="`http://127.0.0.1:8000/images/userDrugs/${drug.img}`" class="drug-image">
                            </td>
                            <td>
                                <img :src="`http://127.0.0.1:8000/images/userDrugs/${drug.exp_img}`" class="drug-image">
                            </td>
                            <td>{{ drug.price }}</td>
                            <td>{{ drug.quantity }}</td>
                            <td>
                                <router-link class="btn btn-success publish-btn btn-sm me-2"
                                    :to="'/User/UpdateDrug/' + drug.id">Update</router-link>|
                                <button class="btn btn-danger delete-btn btn-sm"
                                    @click="deleteDrug(drug.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <button class="buttons btn btn-small  text-light" @click="previousPage"
                        :disabled="currentPage === 1">Previous</button>
                    <span>Page {{ currentPage }} of {{ totalPages }}</span>
                    <button class="buttons btn btn-small  text-light" @click="nextPage"
                        :disabled="currentPage === totalPages">Next</button>
                </div>
            </div>
        </div>
    </div>
</template>
  

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Alkatra&family=Arimo:wght@400;600&family=IBM+Plex+Sans+Arabic:wght@600&family=Inconsolata:wght@700&family=Kanit:wght@500&family=Lilita+One&family=Lobster&family=Montserrat+Alternates:wght@200&family=Pacifico&family=Paytone+One&display=swap");

.drug-image {
    width: 100px;
    height: auto;
}

.owner-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.owner-details {
    display: grid;
    grid-template-rows: auto auto auto;
    align-items: center;
    row-gap: 5px;
}

.owner-image {
    grid-row: 1;
}

.owner-name {
    grid-row: 2;
}

.owner-phone {
    grid-row: 3;
}

.backgroundImage {
    background-image: url("/images/backgroundForDrugDeatails.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    /* Set the container to take full height of the screen */
    height: 110vh;
    font-family: "Montserrat Alternates", sans-serif;
    font-style: normal;
    /* font-weight: bold; */
    /* font-size: 22px; */
  
    
}

.container {
    display: flex;
    height: 100vh;
}

.table-container {
    width: 100%;
    margin: 0 auto;
    margin-top: 4px;
    text-align: center;
 
    
}

.table {
    background-color:white;
    opacity: 0.7;
    text-align: center;
    
}

.backgroundImage .container .table-container .table,
.backgroundImage .container .table-container .table th,
.backgroundImage .container .table-container .table td {
  background-color: white !important;
}

.backgroundImage .container .table-container .table thead tr {
  background-color:white !important;
}

.backgroundImage .container .table thead th {
  font-weight: bold !important;
}

.publish-btn {
    background-color: rgb(201, 201, 14);
    border-color:  rgb(201, 201, 14);
    font-weight: bold;
 
}

.delete-btn {
    background-color: red;
    border-color: red;
    font-weight: bold;
   
}

.pagination {
    justify-content: center;
}
.button-container {
    display: flex;
    justify-content: center;
    margin-bottom: 16px;
  
}
.buttons {
    background-color: #1e56a0;
    font-weight: bold;
    padding: 5px 7px;
    text-decoration: none;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
    margin-top: 4px;

}

.addbutton {
    background-color: #1e56a0;
    font-weight: bold;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 4px;

}
</style>