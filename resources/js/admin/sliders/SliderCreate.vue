<template>
  <div>
    <div class="create-slider-modal" :class="{'show': showModal}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <span v-if="sliderUpdate.id">ویرایش اسلاید</span>
              <span v-else>ساخت اسلاید جدید</span>
            </h5>
            
            <button   
              type="button" 
              class="btn-close ms-0" @click="$emit('showingModal')"
            ></button>

          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data">
              <div class="form-group d-flex align-items-center mb-5">
                <label for="name" class="col-md-3">نام تصویر:</label>
                <div class="col-md-9">
                  <input 
                    type="text" 
                    class="form-control"
                    :class="{'is-invalid': errors.name}"
                    placeholder="لطفاً نام تصویر را وارد نمایید"
                    v-model="sliderName"
                  >
                  <div class="invalid-feedback" v-if="errors.name">
                    <strong>{{ errors.name[0] }}</strong>
                  </div>
                </div>
              </div>
              <div class="form-group d-flex mb-5">
                <label for="image" class="col-md-3">فایل تصویر:</label>
                <div class="col-md-9">
                  <input 
                    type="file" 
                    class="form-control input-file"
                    :class="{'is-invalid': errors.image}"
                    @change="handleFileUpload($event)"
                  >
                  <div class="invalid-feedback" v-if="errors.image">
                    <strong>{{ errors.image[0] }}</strong>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button 
              type="button" 
              class="btn btn-secondary" 
              @click="$emit('showingModal')"
            >بازگشت</button>
            <button 
              type="button" 
              id="submit"
              class="btn btn-primary"
              @click.prevent="submitForm"
            >ایجاد اسلاید</button>
          </div>
        </div>
      </div>
      <div class="modal-bg"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: { showModal: Boolean, sliderUpdate: Object },
  data() {
    return {
      name: null,
      image: null,
      errors: [],
    }
  },
  computed: {
    sliderName: {
      get() {
        return this.sliderUpdate.name !== null ? this.sliderUpdate.name : this.name;
      },
      set(val) {
        if(this.sliderUpdate.name) {
          this.sliderUpdate.name = val;
        } else {
          this.name = val;
        }
      }
    }
  },
  methods: {
    handleFileUpload(event) {
      this.image = event.target.files[0];
    },
    submitForm() {
      if(this.sliderUpdate.name) {
        this.updateSlider();
      } else {
        this.createSlider();
      }
    },
    createSlider() {
      let formData = new FormData();
      formData.append('name', this.name);
      formData.append('image', this.image);

      axios({
        method: 'post',
        url: '/api/admin/sliders',
        data: formData,
        headers: { 'Content-Type': 'multipart/form-data' },
      })
      .then(response => {
        // show success message event
        this.$emit('alertShow', response.data.message);

        // Append new slider in dom
        this.$emit('newSliderAdded', response.data.newSlider);

        // Clear inputs
        let inputFile = document.querySelector('.input-file');
        inputFile.value = '';
        this.name = '';
        this.image = '';

        // Hide modal
        this.$emit('showingModal');
      })
      .catch(error => {
        if(error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      });
    },
    updateSlider() {
      let formData = new FormData();
      formData.append('name', this.sliderUpdate.name);
      formData.append('image', this.sliderUpdate.image);
      formData.append('_method', 'PATCH');

      axios({
        method: 'post',
        url: `/api/admin/sliders/${this.sliderUpdate.id}`,
        data: formData,
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      })
      .then(response => {
        // show success message event
        this.$emit('alertShow', response.data.message);

        // Update slider in dom
        this.$emit('sliderUpdated', response.data.slider);

        // Clear inputs
        let inputFile = document.querySelector('.input-file');
        inputFile.value = '';
        this.name = '';
        this.image = '';

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
  .create-slider-modal {
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
  }

  .create-slider-modal.show {
    display: block;
  }

  .modal-bg {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    display: none;
    width: 100%;
    height: 100%;
    background: #00000035;
  }

  .create-slider-modal.show .modal-bg {
    display: block;
  }

  .modal-dialog {
    transition: transform 0.3s ease-out;
    transform: translateY(-50px);
    z-index: 1050;
  }

  .create-slider-modal.show .modal-dialog {
    transform: none;
  }
</style>