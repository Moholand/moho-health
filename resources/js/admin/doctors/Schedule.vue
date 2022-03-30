<template>
  
  <div class="schedule-modal" v-show="scheduleData.show" @click.self="closeModal">

    <transition name="modal-box">
      <div class="modal-dialog" v-show="scheduleData.show">
  
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                <span>برنامه حضور پزشک</span>
              </h5>
              <button type="button" class="btn-close ms-0" @click="closeModal"></button>
            </div>

            <div class="modal-body">
              <div v-for="(schedule, index) in scheduleData.data" :key="`schedule-${index}`">
                {{ schedule.day }}
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="closeModal">بازگشت</button>
              <!-- <button type="button" id="submit" class="btn btn-primary" @click.prevent="submitForm">ایجاد اسلاید</button> -->
            </div>
          </div>
      
      </div>
    </transition>

  </div>

</template>

<script>
export default {
  props: { scheduleData: Object },
  data() {
    return {
      //
    }
  },
  methods: {
    closeModal() {
      this.$emit('closeModal');
    },
  }
}
</script>

<style scoped>
 .schedule-modal {
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