<template>
  <div class="container">
    <div v-if="loading">Loading ...</div>
    <div v-else class="department">
      <div class="information">
        <h3>{{department.name}}</h3>
        <p class="description mt-3">{{department.about}}</p>
      </div>
      <div class="doctors">
        <h3 class="mt-5 mb-3">لیست پزشکان</h3>
        <div class="doctors-list d-flex flex-wrap">
          <div v-for="(doctor, index) in department.doctors" :key="`doctor-${index}`" class="card doctor-card ms-3 mb-4">
            <img src="/images/doctors/default.jpg" class="card-img-top" :alt="doctor.name">
            <div class="card-body">
              <h5 class="card-title">{{ doctor.name }}</h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
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

<style scoped>
  .description {
    font-size: 18px;
  }

  .doctor-card {
    width: 300px;
  }
</style>