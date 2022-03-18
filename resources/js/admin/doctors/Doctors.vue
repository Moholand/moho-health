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
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
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