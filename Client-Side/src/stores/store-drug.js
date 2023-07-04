import {defineStore} from "pinia";
import axios from 'axios';
export const useStoreDrugs=defineStore("store-drug",{
    state:()=>({
        drugs: null

    }),
    actions:{
        async fetchAllDrugs() {
            const storeData = JSON.parse(sessionStorage.getItem('store'));
            const storeId = storeData.id;
            console.log(storeData);
           // let userID = 2;  // for test
            let resp =  await axios.get(`http://127.0.0.1:8000/api/stores/${storeId}/drugs`);
            console.log(resp)
            console.log(resp.data);
            this.drugs=resp.data
            console.log(this.drugs)
          }

    },
})