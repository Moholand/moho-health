<template>
  <div class="container py-5">
    <h3>لیست پزشکان</h3>

    <loading v-if="loading"></loading>
    <div v-else>
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
        <tbody>
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

      <Pagination :links="links" @getForPage="getForPage"/>
    </div>
    
  </div>
</template>

<script>
import Loading from '../../shared/components/Loading.vue';
import Pagination from '../../shared/components/Pagination.vue';

export default {
  components: { Loading, Pagination },
  data() {
    return {
      loading: false,
      doctors: null,
      links: null
    }
  },
  async created() {
    this.loading = true;

    try {
      let doctorsData = (await axios.get('/api/admin/doctors')).data;
      this.doctors = doctorsData.data;
      this.links = doctorsData.meta.links;
    } catch(error) {
      throw error;
    }

    this.loading = false;
  },
  methods: {
    async getForPage(link) {
      if(!link.url || link.active) {
        return;
      }

      this.loading = true;

      try {
        let doctorsData = (await axios.get(link.url)).data;
        this.doctors = doctorsData.data;
        this.links = doctorsData.meta.links;
      } catch(error) {
        throw error;
      }

      this.loading = false;
    }
  }
}
</script>