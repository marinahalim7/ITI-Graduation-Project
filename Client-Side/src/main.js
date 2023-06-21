import './assets/main.css'
import router from "@/routers";
import { createApp } from 'vue'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';
import '@popperjs/core';
import App from './App.vue'
import {createPinia} from "pinia";
const pinia = createPinia();

createApp(App).use(router).use(pinia).mount('#app')
