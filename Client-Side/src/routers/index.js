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
import paymentForm from "../components/paymentSystem/paymentForm.vue"
const routes = [
  {
        path: '/',
        component: homePage
    },

    {
        path:'/AddDrugInUserDrugs',
        component: AddDrugInUserDrugs
    },
    {
        path:'/UpdateDrugInUserDrugs/:id',
        component: UpdateDrugInUserDrugs
    },
    {
        path:'/AddDrugInPharmacyDrugs',
        component: AddDrugInPharmacyDrugs
    },
    {
        path:'/UpdateDrugInPharmacyDrugs/:id',
        component: UpdateDrugInPharmacyDrugs
    },
    {
        path:'/AddDrugInStoreDrugs',
        component: AddDrugInStoreDrugs
    },
    {
        path:'/UpdateDrugInStoreDrugs/:id',
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
    }

];
const router = createRouter({
    routes: routes,
    history:createWebHistory()
});
export default router;