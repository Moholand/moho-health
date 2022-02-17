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
      user: null,
      token: localStorage.getItem('token')
    }
  },
  created() {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

    this.$store.dispatch('loadUser');

    // Get current user information
    // axios.get('api/user')
    //   .then(response => {
    //     this.user = response.data;
    //     this.$store.commit('setUser', response.data);
    //   })
    //   .catch(error => console.log(error));
  }
}
</script>
