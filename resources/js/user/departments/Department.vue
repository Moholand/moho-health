<template>
  <div class="container">
    <div v-if="loading">Loading ...</div>
    <div v-else class="department">
      <h3>{{department.name}}</h3>
      <p>{{department.about}}</p>
      <div class="doctors">
        <div v-for="(doctor, index) in department.doctors" :key="`doctor-${index}`">
          {{ doctor.name }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      department: null,
      errors: null,
      loading: false
    }
  },
  watch: {
    $route() {
      this.getDepartment()
    }
  },
  created() {
    this.getDepartment()
  },
  methods: {
    async getDepartment() {
      this.loading = true;

      try {
        this.department = (await axios.get(`/api/departments/${this.$route.params.department}`)).data.data
      } catch(error) {
        console.log(error);
      }

      this.loading = false;
    }
  }
}
</script>