<template>
  <div class="register">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <form class="border rounded p-5" autocomplete="off">
          <div class="mb-3">
            <label for="name" class="form-label fw-bold">نام و نام‌خوانوادگی</label>
            <input 
              type="text" 
              id="name" 
              class="form-control" 
              :class="{'is-invalid': errors && errors.name}"
              placeholder="لطفاً نام و نام‌خوانوادگی خود را وارد نمایید..."
              v-model="formData.name"
            />
            <div v-if="errors && errors.name" class="invalid-feedback">
              {{ errors.name[0] }}
            </div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">آدرس ایمیل</label>
            <input 
              type="email" 
              id="email" 
              class="form-control"
              :class="{'is-invalid': errors && errors.email}" 
              placeholder="لطفاً آدرس ایمیل خود را وارد نمایید..."
              v-model="formData.email"
            />
            <div v-if="errors && errors.email" class="invalid-feedback">
              {{ errors.email[0] }}
            </div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label fw-bold">رمز عبور</label>
            <input 
              type="password" 
              class="form-control" 
              :class="{'is-invalid': errors && errors.password}" 
              id="password" 
              placeholder="لطفاً رمز عبور خود را وارد نمایید..."
              v-model="formData.password"
            />
            <div v-if="errors && errors.password" class="invalid-feedback">
              {{ errors.password[0] }}
            </div>
          </div>
          <div class="mb-4"> 
            <label for="password_confirmation" class="form-label fw-bold">تأیید رمز عبور</label>
            <input 
              type="password" 
              class="form-control" 
              id="password_confirmation" 
              placeholder="لطفاً رمز عبور خود را وارد نمایید..."
              v-model="formData.password_confirmation"
            />
          </div>

          <div class="mb-5">
            <div class="form-check mb-2">
              <input 
                class="form-check-input float-end ms-2 my-1" 
                type="radio" name="role" id="user"
                v-model="formData.role"
                :value="'user'"
              >
              <label class="form-check-label" for="patient">
                نام نویسی به عنوان کاربر عادی
              </label>
            </div>
            <div class="form-check">
              <input 
                class="form-check-input float-end ms-2 my-1" 
                type="radio" name="role" id="doctor"
                v-model="formData.role"
                :value="'doctor'"
              >
              <label class="form-check-label" for="doctor">
                نام نویسی به عنوان پزشک
              </label>
              <div v-if="errors && errors.role" class="text-danger">
                {{ errors.role[0] }}
              </div>
            </div>
          </div>
          
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-block" :disabled="submitting" @click.prevent="register">
              <span v-if="!submitting">ثبت نام</span>
              <span v-else>ثبت نام <i class="fas fa-spinner fa-pulse me-3"></i></span>
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        role: "user"
      },
      errors: null,
      submitting: false
    }
  },
  methods: {
    register() {
      this.submitting = true;

      axios.post('api/register', this.formData)
        .then(response => {
          // Clear input fields
          this.formData = {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            role: null
          };

          this.errors = null;

          this.$router.push({ name: 'login' });
        })
        .catch(error => {
          if(error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        })
        .then(() => this.submitting = false);
    }
  }
}
</script>

<style scoped>

</style>