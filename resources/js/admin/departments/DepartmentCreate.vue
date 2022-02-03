<template>
  
    <div class="create-department-modal" v-show="showModal" @click.self="$emit('closeUpdateModal')">

      <transition name="modal-box">
        <div class="modal-dialog" v-show="showModal">
    
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

                  <div class="form-group d-flex align-items-center mb-5">
                    <label for="about" class="col-md-3">درباره دپارتمان:</label>
                    <div class="col-md-9">
                      <textarea 
                        class="form-control"
                        :class="{'is-invalid': errors && errors.about}"
                        placeholder="لطفاً فیلد درباره دپارتمان را وارد کامل نمایید"
                        rows="5"
                        v-model="departmentAbout"
                      ></textarea>
                      <div class="invalid-feedback" v-if="errors && errors.about">
                        <strong>{{ errors.about[0] }}</strong>
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
      </transition>

    </div>

</template>

<script>
export default {
  props: { showModal: Boolean, departmentUpdate: Object },
  data() {
    return {
      formData: {
        name: null,
        about: null
      },
      errors: null
    }
  },
  computed: {
    departmentName: {
      get() {
        return this.departmentUpdate.name ? this.departmentUpdate.name : this.formData.name;
      },
      set(val) {
        if(this.departmentUpdate.name) {
          this.departmentUpdate.name = val;
        } else {
          this.formData.name = val;
        }
      }
    },
    departmentAbout: {
      get() {
        return this.departmentUpdate.about ? this.departmentUpdate.about : this.formData.about;
      },
      set(val) {
        if(this.departmentUpdate.about) {
          this.departmentUpdate.about = val;
        } else {
          this.formData.about = val;
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
        this.formData.about = '';

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
      this.errors = null;
      
      let data = new FormData();
      data.append('name', this.departmentUpdate.name);
      data.append('about', this.departmentUpdate.about);
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
        this.about = '';

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
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
    background: #00000035;
  }

  .modal-dialog {
    z-index: 1050;
  }

  .modal-box-enter-active, .modal-box-leave-active {
    transition: 0.5s all ease;
  }

  .modal-box-enter, .modal-box-leave-to {
    transform: translateY(-50px);
    opacity: 0;
  }
</style>