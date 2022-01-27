<template>
  <div class="create-department-modal" :class="{'show': showModal}" @click.self="$emit('closeUpdateModal')">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">
            <span v-if="departmentUpdate.id">ویرایش دپارتمان</span>
            <span v-else>ایجاد دپارتمان جدید</span>
          </h5>
          <button type="button" class="btn-close ms-0" @click="$emit('closeUpdateModal')"></button>
        </div>

        <div class="modal-body">
          <form>
            <div class="form-group d-flex align-items-center mb-5">
              <label for="name" class="col-md-3">نام دپارتمان:</label>
              <div class="col-md-9">
                <input 
                  type="text" 
                  class="form-control"
                  :class="{'is-invalid': errors && errors.name}"
                  placeholder="لطفاً نام دپارتمان را وارد نمایید"
                  v-model="departmentName"
                >
                <div class="invalid-feedback" v-if="errors && errors.name">
                  <strong>{{ errors.name[0] }}</strong>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="$emit('closeUpdateModal')">بازگشت</button>
          <button type="button" id="submit" class="btn btn-primary" @click.prevent="submitForm">ایجاد اسلاید</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: { showModal: Boolean, departmentUpdate: Object },
  data() {
    return {
      formData: {
        name: null
      },
      errors: null
    }
  },
  computed: {
    departmentName: {
      get() {
        return this.departmentUpdate.name !== null ? this.departmentUpdate.name : this.formData.name;
      },
      set(val) {
        if(this.departmentUpdate.name) {
          this.departmentUpdate.name = val;
        } else {
          this.formData.name = val;
        }
      }
    }
  },
  methods: {
    submitForm() {
      if(this.departmentUpdate.name) {
        this.updateDepartment();
      } else {
        this.createDepartment();
      }
    },
    createDepartment() {
      this.errors = null;

      axios.post('/api/admin/departments', this.formData)
      .then(response => {
        // show success message event
        this.$emit('alertShow', response.data.message);

        // Append new slider in dom
        this.$emit('departmentAdded', response.data.newDepartment);

        // Clear inputs
        this.formData.name = '';

        // Hide modal
        this.$emit('showingModal');
      })
      .catch(error => {
        if(error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      });
    },
    updateDepartment() {
      let data = new FormData();
      data.append('name', this.departmentUpdate.name);
      data.append('_method', 'PATCH');

      axios({
        method: 'post',
        url: `/api/admin/departments/${this.departmentUpdate.id}`,
        data: data,
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      })
      .then(response => {
        // show success message event
        this.$emit('alertShow', response.data.message);

        // Update slider in dom
        this.$emit('departmentUpdated', response.data.department);

        // Clear inputs
        this.name = '';

        // Hide modal
        this.$emit('showingModal');
      })
      .catch(error => {
        if(error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      });
    }
  }
}
</script>

<style scoped>
  .create-department-modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1060;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
    background: #00000035;
  }

  .create-department-modal.show {
    display: block;
  }

  .modal-dialog {
    transition: transform 0.3s ease-out;
    transform: translateY(-50px);
    z-index: 1050;
  }

  .create-department-modal.show .modal-dialog {
    transform: none;
  }
</style>