<template>
  <div class="confirm-modal" v-show="confirmModal" @click.self="closeModal">
    <transition name="modal-box">
      <div class="modal-dialog" v-show="confirmModal">
  
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <span>{{ confirmData.title }}</span>
            </h5>
            <button type="button" class="btn-close ms-0" @click="closeModal"></button>
          </div>

          <div class="modal-body">
            {{ confirmData.body }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">بازگشت</button>
            <button type="button" id="submit" :class="['btn', confirmData.buttonClass]" @click.prevent="submitForm">
              {{ confirmData.buttonText }}
            </button>
          </div>
        </div>
      
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: { confirmModal: Boolean, confirmData: Object },
  data() {
    return {
      //
    }
  },
  methods: {
    submitForm() {
      this.$emit('eventConfirmed');
    },
    closeModal() {
      this.$emit('closeModal');
    },
  }
}
</script>

<style scoped>
 .confirm-modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1060;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
    background: #00000035;
  }

  .modal-dialog {
    z-index: 1050;
  }

  .modal-box-enter-active, .modal-box-leave-active {
    transition: 0.5s all ease;
  }

  .modal-box-enter, .modal-box-leave-to {
    transform: translateY(-50px);
    opacity: 0;
  }
</style>