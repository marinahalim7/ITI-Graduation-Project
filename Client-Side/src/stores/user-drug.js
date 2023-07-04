import {defineStore} from "pinia";
import axios from 'axios';
export const userDrugsStore=defineStore("user-drug",{
    state:()=>({
        drugs: null

    }),
    actions:{
        async fetchAllDrugs() {
            const userData = JSON.parse(sessionStorage.getItem('user'));
            const userId = userData.id;
            let resp =  await axios.get(`http://127.0.0.1:8000/api/user/drugs?id=${userId}`);
            console.log(resp.data);
            this.drugs=resp.data.data
            console.log(this.drugs)
          }

    },
})