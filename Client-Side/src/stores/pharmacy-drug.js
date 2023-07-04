import {defineStore} from "pinia";
import axios from 'axios';
export const usePharmacyDrugsStore=defineStore("pharmacy-drug",{
    state:()=>({
         drugs: null
    }),
    actions:{
        async fetchAllDrugs() {
            const pharmacyData = JSON.parse(sessionStorage.getItem('pharmacy'));
            console.log(pharmacyData);
            const pharmacyId = pharmacyData.id;
           
          //  let pharmacyId = 1;
            let resp =  await axios.get(`http://127.0.0.1:8000/api/pharmacies/drugs?id=${pharmacyId}`);
            console.log(resp);
            this.drugs=resp.data.data
            console.log(this.drugs)
          }

    },
})