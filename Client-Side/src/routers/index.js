import {createRouter , createWebHistory} from "vue-router";
import registerForm from '../components/register/registerForm.vue'
import homePage from '../components/homePage/homePage.vue'
import login from '../components/login/login.vue'
const routes = [
    {
        path: '/register',
        component:registerForm
    },
    {
        path: '/',
        component: homePage
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