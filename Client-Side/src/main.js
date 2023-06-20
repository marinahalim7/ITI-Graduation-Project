import './assets/main.css'
import router from "@/routers";
import { createApp } from 'vue'
import App from './App.vue'
import {createPinia} from "pinia";
const pinia = createPinia();

createApp(App).use(router).use(pinia).mount('#app')
