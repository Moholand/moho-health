<template>
  <div class="login">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <form class="border rounded p-5" autocomplete="off">
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
          <div class="mb-5">
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
          
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-block" @click.prevent="login" :disabled="loading">
              ورود
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { logIn } from "../shared/helpers/auth";

export default {
  data() {
    return {
      formData: {
        email: null,
        password: null,
        device_name: 'browser'
      },
      loading: false,
      errors: null,
    }
  },
  methods: {
    async login() {
      this.loading = true;
      this.errors = null;

      try {
        await axios.get('/sanctum/csrf-cookie');
        const response = await axios.post('/api/login', this.formData);

        localStorage.setItem('token', response.data);
        
        logIn();
        this.$router.push({name: 'home'});
      } catch(error) {
        if(error.response && error.response.status === 422) {
          this.errors = error.response.data.errors
        }
      }
      
      this.loading = false;
    }
  }
}
</script>