import {createRouter , createWebHistory} from "vue-router";
import registerForm from '../components/register/registerForm.vue'
import homePage from '../components/homePage/homePage.vue'
import login from '../components/login/login.vue'

import AddDrugInUserDrugs from "../components/user/AddDrugInUserDrugs.vue"
import UpdateDrugInUserDrugs from "../components/user/UpdateDrugInUserDrugs.vue"
import AddDrugInPharmacyDrugs from "../components/pharmacy/AddDrugInPharmacyDrugs.vue"
import UpdateDrugInPharmacyDrugs from "../components/pharmacy/UpdateDrugInPharmacyDrugs.vue"
import AddDrugInStoreDrugs from "../components/store/AddDrugInStoreDrugs.vue"
import UpdateDrugInStoreDrugs from "../components/store/UpdateDrugInStoreDrugs.vue"
import Home from "../components/user/Home.vue"
const routes = [
  {
        path: '/',
        component: homePage
    },

    {
        path:'/User/AddDrug',
        component: AddDrugInUserDrugs
    },
    {
        path:'/User/UpdateDrug/:id',
        component: UpdateDrugInUserDrugs
    },
    {
        path:'/Pharmacy/AddDrug',
        component: AddDrugInPharmacyDrugs
    },
    {
        path:'/Pharmacy/UpdateDrug/:id',
        component: UpdateDrugInPharmacyDrugs
    },
    {
        path:'/Store/AddDrug',
        component: AddDrugInStoreDrugs
    },
    {
        path:'/Store/UpdateDrug/:id',
        component: UpdateDrugInStoreDrugs
    },
  {
        path: '/register',
        component:registerForm
    },
    {
        path: '/signin',
        component: login
    }

];
const router = createRouter({
    routes: routes,
    history:createWebHistory()
});
export default router;