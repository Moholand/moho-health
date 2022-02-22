<template>
  <div class="container my-5">
    <div class="information">
      <div v-if="loading">Loading ...</div>
      <div class="row" v-else>
        <div class="col-md-4 doctor-image">
          <img src="/images/doctors/default.jpg" :alt="doctor.name">
        </div>
        <div class="col-md-8">
          <p class="doctor-name">{{ doctor.name }}</p>
          <p class="doctor-specialty">فوق تخصص اطفال و فلوشیپ</p>
          <a href="#" class="btn btn-outline-primary">
            رزرو نوبت
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      doctor: null
    }
  },
  async created() {
    this.loading = true;

    try {
      this.doctor = (await axios.get(`/api/doctors/${this.$route.params.doctor}`)).data.data;
    } catch(error) {
      console.log(error);
    }

    this.loading = false;
  }
}
</script>

<style scoped>
  .doctor-image img {
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
  }

  .doctor-name {
    font-size: 20px;
    font-weight: 600;
    color: #2d3436;
  }

  .doctor-specialty {
    font-size: 16px;
    font-weight: 500;
    color: #636e72;
  }
</style>