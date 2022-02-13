<template>
  <div class="container department-list my-5">
    <h3 class="text-center">دپارتمان‌ها</h3>
    <p class="text-center text-muted w-50 mx-auto">
      بیمارستان فوق تخصصي موهو-هلث دارای بخش های تخصصی، بخش های ویژه،
       تالارهاي جراحي فوق تخصصي، كلینیک های فوق تخصصی،
        پاراکلینیک ها و واحد های اداری و پشتيباني می باشد.
    </p>
    <div class="department-list-wrapper d-flex flex-wrap justify-content-center my-5">
      <div 
        v-for="(department, index) in departments" 
        :key="`department-${index}`" 
        class="department-list-item d-flex justify-content-center align-items-center"
      >
        <router-link :to="{name: 'departments.show', params: {department: department.id}}">
          <i :class="[department.logo, 'logo']"></i>
          <div class="cover">
            <span class="cover-title">{{ department.name }}</span>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      departments: null
    }
  },
  async created() {
    this.loading = true;

    try {
      this.departments = (await axios.get(`/api/departments`)).data.data;
    } catch(error) {
      console.log(error);
    }
    
    this.laoding = false;
  }
}
</script>

<style scoped>
  .department-list-item {
    width: 150px;
    height: 150px;
    margin-left: 25px;
    border: 1px solid #54a0ff50;
    border-bottom: 10px solid #54a0ff;
    cursor: pointer;
    position: relative;
  }

  .logo {
    font-size: 90px;
    color: #54a0ff;
    transition: 0.1s all ease-in-out;
  }

  .department-list-item:hover .logo {
    font-size: 110px;
  }

  .cover {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 0;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #54a0ff90;
    overflow: hidden;
    transition: 0.2s all ease;
    color: #333333;
  }

  .department-list-item:hover .cover {
    height: 100%;
  }

</style>
