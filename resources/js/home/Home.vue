<template>
  <div>
    <home-slider></home-slider>
  </div>
</template>

<script>
import HomeSlider from './home-slider/HomeSlider.vue';

export default {
  components: { HomeSlider },
  data() {
    return {
      currentUser: null,
      token: localStorage.getItem('token')
    }
  },
  created() {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

    // Get current user information
    axios.get('api/user')
      .then(response => this.currentUser = response.data)
      .catch(error => console.log(error));
  },
}
</script>
