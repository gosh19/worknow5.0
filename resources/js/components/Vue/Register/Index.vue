<script>
import Step1 from './Step1.vue';
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  components: {
    Step1,
    Carousel,
    Slide,
    Pagination,
    Navigation,
  }
}
</script>

<template>
  <carousel >
    <slide v-for="slide in 10" :key="slide">
      {{ slide }}
    </slide>

    <template #addons>
      <navigation />
      <pagination />
    </template>
  </carousel>
</template>
