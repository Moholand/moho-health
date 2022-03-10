<template>
  <transition name="alert-box">
    <div class="custom-alert" v-show="alertData.show">
      <div class="d-flex justify-content-between align-items-center flex-grow-1">
        <span>{{ alertData.message }}</span>
        <span aria-hidden="true">&times;</span>
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
    width: 350px;
    height: 80px;
    border-radius: 5px;
    font-weight: bold;
    padding: 10px 25px 10px 10px;
  }

  .custom-alert:after {
    content: '';
    position: absolute;
    width: 10px;
    height: 100%;
    right: 0;
    border: 0 5px 5px 0;
    background: #55efc4; 
  }

  .alert-box-enter-active, .alert-box-leave-active {
    transition: 0.5s all ease;
  }

  .alert-box-enter, .alert-box-leave-to {
    transform: translateX(100px);
    opacity: 0;
  }
</style>