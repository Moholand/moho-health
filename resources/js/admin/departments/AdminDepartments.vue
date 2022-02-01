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
          <th scope="col">نام دپارتمان</th>
          <th scope="col">تاریخ ایجاد</th>
          <th scope="col">ویرایش/حذف</th>
        </tr>
      </thead>
      
      <loading v-if="loading"></loading>
      <tbody>
        <tr v-for="(department, index) in departments" :key="`department-${index}`">
          <th scope="row">{{ ++index }}</th>
          <td>{{ department.name }}</td>
          <td>{{ department.updated_at }}</td>

          <td>
            <!-- Update department btn -->
            <button class="bg-transparent border-0" @click="showingUpdateModal(department.id, department.name)">
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
      }
    }
  },
  created() {
    this.loading = true;

    axios.get('/api/admin/departments')
      .then(response => {
        this.departments = response.data.data;
      })
      .then(this.loading = false);
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
          this.departments = response.data.departments;
      });
    },
    showingUpdateModal(id, name) {
      this.showingModal();
      this.departmentUpdate = {
        id,
        name
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
        name: null,
      }
    }
  }
}
</script>