<template>
  <div>
    <!-- Modal -->
    <div 
      class="modal fade" 
      id="createSliderModal" 
      tabindex="-1" 
      aria-labelledby="createSliderModalLabel" 
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createSliderModalLabel">
                ایجاد اسلاید جدید
            </h5>
            <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
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
                    v-model="name"
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
                    class="form-control"
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
              data-bs-dismiss="modal"
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
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: null,
      image: null,
      errors: [],
    }
  },
  methods: {
    handleFileUpload(event) {
      this.image = event.target.files[0];
    },
    submitForm() {
      let formData = new FormData();
      formData.append('name', this.name);
      formData.append('image', this.image);

      axios({
        method: 'post',
        url: '/api/admin/home-sliders',
        data: formData,
        headers: { 'Content-Type': 'multipart/form-data' },
      })
      .then(response => {
        // show success message event
        this.$emit('alertShow', response.data.message);

        // Clear inputs
        this.name = '';
        this.image = '';

        // Hide modal
        // this.hideModal()
        // let myModalEl = document.querySelector('#createSliderModal');
        // let myModal = bootstrap.Modal.getOrCreateInstance(myModalEl);
        // myModal.hide();
      })
      .catch(error => {
        console.log('hiii');
        if(error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      });
    },
    // hideModal() {
    //   let theModal = document.getElementById('createSliderModal');
    //   let ModalBackdrop = document.querySelector('.modal-backdrop');
    //   let Body = document.getElementsByTagName('body')[0];

    //   theModal.classList.remove('show');
    //   theModal.style.display = 'none';
    //   ModalBackdrop.classList.remove('show');
    //   ModalBackdrop.remove();
    //   Body.classList.remove('modal-open');
    //   Body.style.overflow = null;
    //   Body.style.padding = null;
    // }
  }
}
</script>