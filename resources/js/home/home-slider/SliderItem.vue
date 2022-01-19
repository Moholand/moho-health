<template>
  <div class="slider-item" :class="{'show': currentSlide === iteration}">
    <img :src="`/images/sliders/${slider.image}`" :alt="slider.name">
  </div>
</template>

<script>
export default {
  props: { slider: Object, iteration: Number, currentSlide: Number },
  data() {
    return {
      
    }
  },
  computed: {

  }
}
</script>

<style scoped>
  .slider-item {
    position: absolute;
    top:0;
    left: 0;
    z-index: 40;
    display: none;
  }
  
  .slider-item.show {
    display: block;
  }

  .slider-item img {
    max-width: 100%;
    max-height: 500px;
  }
</style>
