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
            <th scope="col">برنامه حضور</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(doctor, index) in doctorsData.data" :key="`doctor-${index}`">
            <th scope="row">
              {{ ((doctorsData.meta.current_page - 1) * doctorsData.meta.per_page) + (index + 1) }}
            </th>
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
            <td class="px-4 text-primary">
              <i class="fas fa-clipboard-list fa-lg schedule-icon" @click="seeSchedule(doctor.schedule, doctor.name)"></i>
            </td>
          </tr>
        </tbody>
      </table>

      <Pagination :links="doctorsData.meta.links" @getForPage="getForPage"/>
    </div>
    
  </div>

  <Schedule :scheduleData="scheduleData" @closeModal="closeSchedule" />
</template>

<script>
import Loading from '../../shared/components/Loading';
import Pagination from '../../shared/components/Pagination';
import Schedule from './Schedule';

export default {
  components: { Loading, Pagination, Schedule },
  data() {
    return {
      loading: false,
      doctorsData: null,
      scheduleData: {
        show: false,
        data: null,
        name: null
      }
    }
  },
  created() {
    this.getForPage();
  },
  methods: {
    async getForPage(link = {}) {
      link.url = link && link.url ? link.url : '/api/admin/doctors';

      if(!link.url || link.active) {
        return;
      }

      this.loading = true;

      try {
        this.doctorsData = (await axios.get(link.url)).data;
      } catch(error) {
        throw error;
      }

      this.loading = false;
    },
    seeSchedule(data, name) {
      this.scheduleData.data = data;
      this.scheduleData.name = name;
      this.showSchedule();
    },
    closeSchedule() {
      this.scheduleData.data = null;
      this.scheduleData.name = null;
      this.showSchedule()
    },
    showSchedule() {
      this.scheduleData.show = !this.scheduleData.show;
    }
  }
}
</script>

<style scoped>
  .schedule-icon {
    cursor: pointer;
  }
</style>