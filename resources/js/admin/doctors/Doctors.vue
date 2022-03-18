<template>
  <div class="container py-5">
    <h3>لیست پزشکان</h3>
    <table class="table table-hover mt-4">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">نام و نام خوانوادگی</th>
          <th scope="col">ایمیل</th>
          <th scope="col">دپارتمان</th>
          <th scope="col">تخصص</th>
        </tr>
      </thead>
      <loading v-if="loading"></loading>
      <tbody v-else>
        <tr v-for="(doctor, index) in doctors" :key="`doctor-${index}`">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ doctor.name }}</td>
          <td>{{ doctor.email }}</td>
          <td>
            <span v-if="doctor.department">{{ doctor.department.name }}</span>
            <span v-else>-</span>
          </td>
          <td>
            <span v-if="doctor.expertise">{{ doctor.expertise }}</span>
            <span v-else>-</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Loading from '../../shared/components/Loading.vue';
export default {
  components: { Loading },
  data() {
    return {
      loading: false,
      doctors: null
    }
  },
  async created() {
    this.loading = true;

    try {
      this.doctors = (await axios.get('/api/admin/doctors')).data.data;
    } catch(error) {
      throw error;
    }

    this.loading = false;
  }
}
</script>