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
          },
          courses:[1,2],
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
  },
  computed:{
    setCourses(){
      this.courses = [3,4];
      console.log(this.courses);
      return this.courses;
    }
  },
  beforeCreate(){
    this.courses = [3,4];
    fetch('/api/courses/get-all')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
          //this.courses=data;
          
        })
        .catch(function(e) {
          console.log(e);
        })
  },
  setup(){
    
  }
}
</script>

<template>
  <carousel :mouseDrag="false">
    <slide v-for="step in 3" :key="step">
        <Step1 v-if="step == 1"
                :user="user"
        />
        <Step2 v-if="step == 2"
                :courses="courses"
        />
        <Step3 v-if="step == 3"/>
    </slide>

    <template #addons>
      <navigation />
      <pagination />
    </template>
  </carousel>
</template>
