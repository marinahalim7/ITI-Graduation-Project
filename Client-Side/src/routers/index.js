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
import pharmacyRegister from "../components/register/pharmacyRegister.vue"
import storeRegister from "../components/register/storeRegister.vue"
import Home from "../components/user/Home.vue"
import PharmacyHomePage from "../components/pharmacy/Home.vue"
import StroreHomePage from "../components/store/Home.vue"
import UserHomePage from "../components/user/Home.vue"
import AdminHomePage from "../components/admin/Home.vue"

import paymentForm from "../components/paymentSystem/paymentForm.vue"
const routes = [
  {
        path: '/',
        component: homePage
    },
    {
        path:'/user/home',
        component: UserHomePage
    },
    {
        path:'/pharmacy/home/',
        component: PharmacyHomePage
    },
    {
        path:'/store/home/',
        component: StroreHomePage
    },
    {
        path:'/admin/home/',
        component: AdminHomePage
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
        path: '/register/user',
        component:registerForm
    },
    {
        path: '/signin',
        component: login
    },
    {
        path: '/register/pharmacy',
        component:pharmacyRegister
    },
    {
        path: '/register/store',
        component:storeRegister
    },
    {
        path: '/payment',
        component: paymentForm
    },
    {
        path:'/pharmacy/search',
        component: PharmacySearch
    },
    {
        path:'/user/search',
        component: UserSearch
    },

];
const router = createRouter({
    routes: routes,
    history:createWebHistory()
});
export default router;