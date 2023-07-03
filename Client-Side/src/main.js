import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';

import router from "@/routers/index";
import { createApp } from 'vue'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';
import '@popperjs/core';
import App from './App.vue'
import {createPinia} from "pinia";
const pinia = createPinia();

createApp(App).use(router).use(pinia).mount('#app')
