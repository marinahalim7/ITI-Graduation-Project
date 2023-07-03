<template>
  <div class="backgroundImag">
    <div class="page-container">
      <div class="form-container">
        <div class="d-flex justify-content-center">
          <h3 class="FormTitle">Update Drug In Store Drugs</h3>
        </div>

        <form @submit="submitForm">
          <!-- Drug Name -->
          <div class="d-flex justify-content-center">
            <div class="form-floating my-3 mt-5">
              <input
                v-model="name"
                type="text"
                class="form-control text-center"
                id="DrugName"
                placeholder="Drug Name"
                style="height: 73px"
              />
              <label class="textFloating ms-5" for="DrugName"
                ><i class="fa-solid fa-capsules me-2" style="height: 25px;"></i
                > Drug Name</label
              >
              <div
                v-if="errors.name"
                class="alert alert-danger p-2 mt-2"
                style="width: 300px;"
                role="alert"
              >
                {{ errors.name }}
              </div>
            </div>
          </div>

          <!-- Drug Image -->
          <div class="d-flex justify-content-center bgIamge">
            <div class="form my-3 mb-4">
              <input
                type="file"
                class="form-control"
                id="DrugImage"
                ref="drugImageInput"
                placeholder="Drug Image"
                hidden
                style="height: 73px"
              />
              <label class="textFloating me-5" for="DrugImage">
                <i
                  class="fa-solid fa-cloud-arrow-up me-2"
                  style="height: 25px"
                ></i
                >Drug Image
              </label>
            </div>
          </div>

          <!-- Price -->
          <div class="d-flex justify-content-center">
            <div class="form-floating my-3">
              <input
                v-model="price"
                type="number"
                class="form-control text-center"
                id="Price"
                placeholder="Price"
                style="height: 73px"
              />
              <label class="textFloating ms-4" for="Price"
                ><i
                  class="fa-solid fa-hand-holding-dollar me-2"
                  style="height: 25px"
                ></i
                >Price
              </label>
            </div>
          </div>

          <!-- Quantity -->
          <div class="d-flex justify-content-center">
            <div class="form-floating my-2">
              <input
                v-model="quantity"
                type="number"
                class="form-control text-center"
                id="Quantity"
                placeholder="Quantity"
                style="height: 73px"
              />
              <label class="textFloating ms-4" for="Quantity"
                ><img class="me-2" width="30" src="/images/Q.png" />Quantity</label
              >
            </div>
          </div>

          <div class="d-flex justify-content-center mt-4">
            <button class="btn">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<!-- the logic and script here validation and functions-->
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Swal from 'sweetalert2';
import { useRoute } from "vue-router";


const name = ref('');
const price = ref('');
const quantity = ref('');
const drugImageInput = ref(null); 
const errors = ref({
  name: '',
});

const route = useRoute();
const drugId = ref(route.params.id); 

// Fetch the existing drug data
onMounted(async () => {
  try {
    const storeId = 9;  // [[[get the store Id from the session]]]

    const response = await axios.get(`http://localhost:8000/api/stores/${storeId}/drugs/${drugId.value}`);
    const drugData = response.data;

    name.value = drugData.name;
    price.value = drugData.price;
    quantity.value = drugData.quantity;
  } catch (error) {
    console.error("Error:", error.response.data);
  }
});

const submitForm = async (event) => {
  event.preventDefault();
  errors.value = {};

  // Validate form inputs
  if (name.value.length < 3) {
    errors.value.name = 'Drug Name should be at least 3 characters';
  }

  // Check if there are any errors
  const hasErrors = Object.values(errors.value).some((error) => error !== '');
  if (hasErrors) {
    return;
  }

  const formData = new FormData();
  formData.append("name", name.value);
  formData.append("price", price.value);
  formData.append("quantity", quantity.value);
  formData.append("img", drugImageInput.value.files[0]); 

  formData.append("_method", "put");

  try {
    const storeId = 9;  // [[[get the store Id from the session]]]

    const response = await axios.post(
      `http://localhost:8000/api/stores/${storeId}/drugs/${drugId.value}`,
      formData,
      {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }
    );

    Swal.fire({
      icon:  'success',
      title: 'Success!',
      text:  'Drug updated successfully',
    });

    console.log("Success:", response.data);
  } catch (error) {
    console.error("Error:", error.response.data);
  }
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Alkatra&family=Arimo:wght@400;600&family=IBM+Plex+Sans+Arabic:wght@600&family=Inconsolata:wght@700&family=Kanit:wght@500&family=Lilita+One&family=Lobster&family=Montserrat+Alternates:wght@200&family=Pacifico&family=Paytone+One&display=swap");

.backgroundImag {
  background-image: url("../../../public//images/backgroundForDrugDeatails.png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}


.form-container {
  width: 100%;
  max-width: 500px;
  margin-top: 50px;
  padding: 20px;
  box-shadow: 0px 0px 2px 2px #1632727d;
  background-color: #ffffff;
  border-radius: 5px;

    /* Media query for small screens */
    @media (max-width: 576px) {
    margin-top: 20px; /* Reduce the top margin for smaller screens */
    padding: 10px; /* Reduce the overall padding for smaller screens */
  }
}
.form-control {
  background-color: #84c7f9;
  width: 300px;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 8px;
  font-family: "Montserrat Alternates", sans-serif;
  font-style: normal;
  font-weight: bold;
  font-size: 22px;
  color: #294d8b;
}
.page-container {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  height: 115vh; /*  height of the container to the full viewport height */
  padding-left: 70px; 

  /* Media query for small screens */
  @media (max-width: 576px) {
    padding-left: 10px; 
  }
}
.textFloating {
  font-family: "Montserrat Alternates", sans-serif;
  font-style: normal;
  font-weight: bold;
  font-size: 20px;
  color: #294d8b;
}
.form-control:hover {
  cursor: pointer;
  background-color: #50a4e4;
}
.btnHidden {
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border: 1px solid #d6d5d5;
  background-color: #84c7f9;
  border-radius: 8px;
  font-family: "Montserrat Alternates", sans-serif;
  font-style: normal;
  font-weight: bold;
  font-size: 22px;
  color: #294d8b;
  height: 74px;
  width: 295px;
}
.btnHidden:hover {
  cursor: pointer;
  background-color: #50a4e4;
}
.btn {
  background: #294d8b;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
  color: #ffffff;
  width: 120px;
  font-family: "Montserrat Alternates", sans-serif;
  font-style: normal;
  font-weight: bold;
  font-size: 20px;
}
.FormTitle {
  font-family: "Montserrat Alternates", sans-serif;
  font-style: normal;
  font-weight: bold;
  font-size: 30px;
  color: #163172;
}

.bgIamge {
  background-color: #84c7f9;

  width: 300px;
  height: 70px;
  margin-left: 80px;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 8px;

  /* Media query for small screens */
  @media (max-width: 576px) {
    margin-left: 42px;

  }
}

</style>
