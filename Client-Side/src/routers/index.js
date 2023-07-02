import {createRouter , createWebHistory} from "vue-router";
import AddDrugInUserDrugs from "../components/user/AddDrugInUserDrugs.vue"
import UpdateDrugInUserDrugs from "../components/user/UpdateDrugInUserDrugs.vue"
import AddDrugInPharmacyDrugs from "../components/pharmacy/AddDrugInPharmacyDrugs.vue"
import UpdateDrugInPharmacyDrugs from "../components/pharmacy/UpdateDrugInPharmacyDrugs.vue"
import AddDrugInStoreDrugs from "../components/store/AddDrugInStoreDrugs.vue"
import UpdateDrugInStoreDrugs from "../components/store/UpdateDrugInStoreDrugs.vue"
import Home from "../components/user/Home.vue"
const routes = [
    {
        path:'/',
        component: Home
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


];
const router = createRouter({
    routes: routes,
    history:createWebHistory()
});
export default router;