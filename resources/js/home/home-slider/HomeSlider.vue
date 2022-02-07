<template>
  <div class="slider">
    <slider-item 
      v-for="(slider, index) in sliders" 
      :key="`slider-${index}`"
      :slider="slider"
      :iteration="++index"
      :currentSlide="currentSlide"
    ></slider-item>
    <div class="slider-btn d-flex justify-content-between">
      <button class="btn bg-light rounded-circle d-flex" @click="nextSlide">
        <i class="fas fa-angle-right fa-lg"></i>
      </button>
      <button class="btn bg-light rounded-circle d-flex" @click="prevSlide">
        <i class="fas fa-angle-left fa-lg"></i>
      </button>
    </div>
  </div>
</template>

<script>
import SliderItem from './SliderItem';

export default {
  components: { SliderItem },
  data() {
    return {
      sliders: null,
      currentSlide: 1
    }
  },
  created() {
    axios.get('api/sliders')
      .then(response => this.sliders = response.data.data)
      .catch(error => console.log(error));
  },
  methods: {
    nextSlide() {
      console.log(this.sliders.length)
      this.currentSlide = (this.currentSlide === this.sliders.length) ? 1 : (this.currentSlide + 1);
    },
    prevSlide() {
      this.currentSlide = (this.currentSlide === 1) ? this.sliders.length : (this.currentSlide - 1);
    }
  }
}
</script>

<style scoped>
  .slider {
    position: relative;
    height: 475px;
  }

  .slider-btn {
    position: absolute;
    left: 20px;
    right: 20px;
    top: 220px;
    z-index: 45;
  }

  .slider-btn button {
    padding: 10px 12px;
  }

</style>
