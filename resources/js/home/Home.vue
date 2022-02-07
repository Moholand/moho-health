<template>
  <div>
    <home-slider></home-slider>
    <department-list></department-list>
  </div>
</template>

<script>
import HomeSlider from './home-slider/HomeSlider';
import DepartmentList from './departments/DepartmentList';

export default {
  components: { HomeSlider, DepartmentList },
  data() {
    return {
      currentUser: null,
      token: localStorage.getItem('token'),
      test: false
    }
  },
  created() {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

    // Get current user information
    axios.get('api/user')
      .then(response => {
        this.currentUser = response.data;
        this.$store.commit('setCurrentUser', response.data);
      })
      .catch(error => console.log(error));
  }
}
</script>
