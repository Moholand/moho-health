<template>
  <div class="header">
    <nav class="navbar navbar-expand-lg navbar-light flex-column">
      <div class="container py-2">
        <router-link :to="{ name: 'home'}" class="navbar-brand">
          <i class="fas fa-heartbeat text-primary"></i>
          <span>MOHOLAND</span>
        </router-link>
        <div class="search-wrapper">
          <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto d-flex align-items-center">
            <input type="search" class="form-control" placeholder="جستجو...">
            <i class="fas fa-search text-secondary"></i>
          </form>
        </div>
      </div>
      <div class="container py-2">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 pe-3">
            <li class="nav-item d-flex align-items-center">
              <router-link :to="{ name: 'home'}" aria-current="page" class="nav-link">
                <i class="fas fa-home fa-sm"></i>
                <span class="nav-menu">خانه</span>
              </router-link>
            </li>
            <li class="nav-item d-flex align-items-center me-5">
              <div class="dropdown">
                <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                  <i class="far fa-building fa-sm"></i>
                  <span class="nav-menu">دپارتمان‌ها</span>
                </a>
                <ul class="dropdown-menu">
                  <li v-for="(department, index) in departments" :key="`department-${index}`" class="text-end">
                    <router-link :to="{ name: 'departments.show', params: { department: department.id }}" class="dropdown-item">
                      {{ department.name }}
                    </router-link>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item d-flex align-items-center me-5">
              <router-link :to="{ name: 'about'}" class="nav-link">
                <i class="fas fa-laptop-medical fa-sm"></i>
                <span class="nav-menu">درباره ما</span>
              </router-link>
            </li>
          </ul>

          <ul class="navbar-nav ms-4">

            <div v-if="isLoggedIn" class="d-flex">
              <li class="nav-item me-3">
                <div class="dropdown">
                  <button 
                    class="bg-transparent nav-link border-0 dropdown-toggle" 
                    type="button" 
                    id="userMenu" data-bs-toggle="dropdown"
                  >
                    {{ user.name }}
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="userMenu">
                    <li>
                      <router-link class="dropdown-item text-end nav-link" :to="{name: 'admin.doctors'}">
                        لیست پزشکان
                      </router-link>
                    </li>
                    <li>
                      <router-link class="dropdown-item text-end nav-link" :to="{name: 'admin-sliders'}">
                        تنظیمات پیمایشگر
                      </router-link>
                    </li>
                    <li>
                      <router-link class="dropdown-item text-end nav-link" :to="{name: 'admin-departments'}">
                        تنظیمات دپارتمان‌ها
                      </router-link>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item me-3">
                <button class="bg-transparent nav-link border-0" @click.prevent="logout">خروج</button>
              </li>
            </div>

            <div class="d-flex" v-else>
              <li class="nav-item">
                <router-link :to="{name: 'login'}" class="nav-link">
                  ورود
                </router-link>
              </li>
              <li class="nav-item me-3">
                <router-link :to="{name: 'register'}" class="nav-link">
                  نام‌نویسی
                </router-link>
              </li>
            </div> 

          </ul>

        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      departments: null,
    }
  },
  computed: {
    ...mapState(['isLoggedIn', 'user']),
  },
  async mounted() {
    try {
      this.departments = (await axios.get('/api/departments')).data.data;
    } catch(erorr) {
      console.log(erorr);
    }
  },
  methods: {
    logout() {
      axios.post('api/logout')
        .then(response => {
          localStorage.removeItem('token');
          this.$store.dispatch('logout');
          this.$router.push({ name: 'login' });
        })
        .catch(error => this.$store.dispatch('logout'));
    }
  }
}
</script>

<style scoped> 
  .header {
    background-image: linear-gradient(to top, #54a0ff15 , #54a0ff05)
  }

  .navbar-brand {
    color: #41464b;
    background: #e2f3ff;
    padding: 5px 15px;
    border-radius: 20px;
  }

  .navbar-brand:hover, .navbar-brand:focus {
    color: #ffffff;
    background: #6cbbf5;
  }

  .nav-menu {
    font-size: 15px;
  }

  .search-wrapper form {
    position: relative;
  }

  .search-wrapper input {
    border-radius: 10px;
  }

  .search-wrapper i {
    position: absolute;
    left: 15px;
  }
</style>
