<template>
  <div class="container">
    doctor detail...
  </div>
</template>

<script>
export default {
  data() {
    return {
      doctor: null
    }
  },
  async created() {
    try {
      this.doctor = (await axios.get(`/api/doctors/${this.$route.params.doctor}`)).data.data;
    } catch(error) {
      console.log(error);
    }
  }
}
</script>