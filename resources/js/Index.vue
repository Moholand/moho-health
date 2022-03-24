<template>
  <div>

    <Header />

    <div class="content py-4">
      <router-view></router-view>
    </div>

    <Footer />

  </div>
</template>

<script>
import Header from './shared/components/Header';
import Footer from './shared/components/Footer';
import { isLoggedIn } from './shared/helpers/auth';

export default {
  components: { Header, Footer },
  async beforeCreate() {
		this.$store.commit('setLoggedIn', isLoggedIn());
		this.$store.dispatch('loadUser');
	}
}
</script>

<style scoped>
  .content {
    min-height: 700px;
  }
</style>