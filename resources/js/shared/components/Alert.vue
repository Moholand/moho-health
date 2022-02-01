<template>
  <transition name="alert-box">
    <div class="custom-alert" v-show="alertData.show">
      <div class="row mx-0">
        {{ alertData.message }}
      </div>
    </div>
  </transition>
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

  .alert-box-enter-active, .alert-box-leave-active {
    transition: 0.5s all ease;
  }

  .alert-box-enter, .alert-box-leave-to {
    transform: translateX(100px);
    opacity: 0;
  }
</style>