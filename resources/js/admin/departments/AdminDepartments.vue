<template>
  <div class="container py-4 admin-departments">
    <div class="page-title d-flex justify-content-between align-items-center">
      <h3>دپارتمان‌ها</h3>
      <button class="btn btn-outline-primary" @click="showingModal">دپارتمان جدید</button>
    </div>
    <hr>

    <alert :alertData="alertData"></alert>

    <department-create 
      @showingModal="showingModal" 
      @departmentAdded="departmentAdded"
      @departmentUpdated="departmentUpdated"
      @closeUpdateModal="closeUpdateModal"
      @alertShow="alertShow"
      :showModal="departmentCreateModal"
      :departmentUpdate="departmentUpdate"
    ></department-create>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">لوگو</th>
          <th scope="col">نام دپارتمان</th>
          <th scope="col">درباره دپارتمان</th>
          <th scope="col">تاریخ ایجاد</th>
          <th scope="col">ویرایش/حذف</th>
        </tr>
      </thead>
      
      <loading v-if="loading"></loading>
      <tbody v-else>
        <tr v-for="(department, index) in departments" :key="`department-${index}`">
          <th scope="row">{{ ++index }}</th>
          <td>{{ department.logo }}</td>
          <td>{{ department.name }}</td>
          <td>{{ department.about.substr(0, 40) }}</td>
          <td>{{ department.updated_at }}</td>

          <td>
            <!-- Update department btn -->
            <button 
              class="bg-transparent border-0" 
              @click="showingUpdateModal(department.id, department.logo, department.name, department.about)"
            >
              <i class="fas fa-edit fa-lg text-primary"></i>
            </button>
            <!-- Delete department btn -->
            <button class="bg-transparent border-0 me-3" @click.prevent="deleteDepartment(department.id)">
              <i class="fas fa-trash fa-lg text-danger"></i>
            </button>
          </td>

        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import DepartmentCreate from './DepartmentCreate';

export default {
  components: { DepartmentCreate },
  data() {
    return {
      loading: false,
      departmentCreateModal: false,
      departments: null,
      alertData: {
        show: null,
        message: null
      },
      departmentUpdate: {
        id: null,
        name: null,
        logo: null,
        about: null
      }
    }
  },
  mounted() {
    this.loading = true;

    axios.get('/api/admin/departments')
      .then(response => {
        this.departments = response.data.data;
      })
      .then(() => this.loading = false);
  },
  methods: {
    showingModal() {
      this.departmentCreateModal = !this.departmentCreateModal;
    },
    closeUpdateModal() {
      this.resetDepartmentUpdateData();
      this.showingModal();
    },
    alertShow(event) {
      this.alertData = {
        show: true,
        message: event
      };
    },
    departmentAdded(department) {
      this.departments.push(department);
    },
    deleteDepartment(department_id) {
      axios.delete(`/api/admin/departments/${department_id}`)
        .then(response => {
          // Show Success alert
          this.alertData = {
            show: true,
            message: response.data.message
          };
          // reRendered departments item
          this.departments = this.departments.filter(department => department.id !== department_id);
      });
    },
    showingUpdateModal(id, logo, name, about) {
      this.showingModal();
      this.departmentUpdate = {
        id,
        logo,
        name,
        about
      }
    },
    departmentUpdated(newDepartment) {
      // Add updated department to the DOM
      this.departments = this.departments.map(department => {
        return (department.id === newDepartment.id) ? newDepartment : department;
      });

      this.resetDepartmentUpdateData();
    },
    resetDepartmentUpdateData() {
      this.departmentUpdate = {
        id: null,
        logo: null,
        name: null,
        about: null
      }
    }
  }
}
</script>