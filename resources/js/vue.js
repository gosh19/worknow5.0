import { createApp } from 'vue'

import Index from './components/Vue/Register/Index.vue';

const app = createApp({});
app.component('index', Index)

app.mount('#register')