<template>
  <div class="container my-5">
    <div v-if="loading">Loading ...</div>
    <div v-else class="department">
      <div class="information">
        <h2>{{department.name}}</h2>
        <div class="description d-flex align-items-center">
          <i :class="[department.logo, 'logo', 'p-5']"></i>
          <p class="about mt-3 w-50">{{department.about}}</p>
        </div>
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
              <router-link :to="{name: 'doctors.detail', params: {doctor: doctor.id}}" class="btn btn-primary">Go somewhere</router-link>
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
  .about {
    font-size: 18px;
  }
  
  .logo {
    font-size: 100px;
    color: #1B9CFC;
  }

  .doctor-card {
    width: 300px;
  }
</style>