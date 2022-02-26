<template>
  <div class="container my-5">
    <div class="information pb-5">
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
    <div class="schedule pt-5">
      <h3>برنامه حضور پزشک:</h3>
      <div v-if="loading">Loading ...</div>
      <table class="table table-striped table-hover mt-4" v-else>
        <thead>
          <tr>
            <th scope="col">روز</th>
            <th scope="col" v-for="(hour, index) in hours" :key="`hour-${index}`">
              {{ hour }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(day, index) in days" :key="`day-${index}`">
            <th scope="row">{{ day }}</th>
            <th scope="col" v-for="(hour, index) in hours" :key="`hour-${index}`">
              <span v-if="checkForPresense(day, hour)">حضور دارد</span>
              <span v-else>X</span>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      doctor: null,
      days: ['شنبه',
              'یکشنبه',
              'دوشنبه',
              'سه‌شنبه',
              'چهارشنبه',
              'پنج‌شنبه',
              'جمعه'],
      hours: ['8-10', '10-12', '13-15', '15-17', '17-19'],
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
  },
  methods: {
    checkForPresense(day, hour) {
      let presense = false;

      this.doctor.schedule.forEach(presenseObj => {
        if(presenseObj.day === day && presenseObj.hour === hour) {
          presense = true;
        }
      });

      return presense;
    }
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