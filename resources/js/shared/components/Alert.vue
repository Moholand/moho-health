<template>
  <div class="custom-alert" v-show="alertData.show">
    <div class="row mx-0">
      {{ alertData.message }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    alertData: Object
  },
  watch: {
    alertData: function(data) {
      setTimeout(function() {
        data.show = false;
      }, 5000);
    }
  }
}
</script>

<style scoped>
  .custom-alert {
    position: fixed;
    top: 10%;
    right: 5%;
    background: #55efc4;
    color: #ffffff;
    width: 300px;
    height: 50px;
    border-radius: 5px;
    font-weight: bold;
    padding: 10px;
  }
</style>