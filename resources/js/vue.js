import { createApp } from 'vue'

import ExampleComponent from './components/Vue-test/ExampleComponent.vue';

const app = createApp({});
app.component('example-component', ExampleComponent)

app.mount('#app')