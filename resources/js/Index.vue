<template>
  <div>

    <Header />

    <div class="content py-5">
      <router-view></router-view>
    </div>

    <Footer />

  </div>
</template>

<script>
import Header from './shared/components/Header';
import Footer from './shared/components/Footer';

export default {
  components: { Header, Footer }
}
</script>

<style scoped>
  .content {
    min-height: 500px;
  }
</style>