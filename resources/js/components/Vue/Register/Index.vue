<script>
import Step1 from './Step1.vue';
import Step2 from './Step2.vue';
import Step3 from './Step3.vue';
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
    data(){
        return{
            step:1,
            user:{
                name:'asd',
                password:'',
                email:'',
                phone:''
            }
        }
    },
  components: {
    Step1,
    Step2,
    Step3,
    Carousel,
    Slide,
    Pagination,
    Navigation,
  }
}
</script>

<template>
    {{step}}
  <carousel >
    <slide v-for="step in 3" :key="step">

        <Step1 v-if="step == 1"
                v-bind:user="user"
        />
        <Step2 v-if="step == 2"/>
        <Step3 v-if="step == 3"/>
    </slide>

    <template #addons>
      <navigation />
      <pagination />
    </template>
  </carousel>
</template>
