<template>
  
  <div class="schedule-modal" v-show="scheduleData.show" @click.self="closeModal">

    <transition name="modal-box">
      <div class="modal-dialog" v-show="scheduleData.show">
  
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                <span>برنامه حضور</span> <span>{{ scheduleData.name }}</span>
              </h5>
              <button type="button" class="btn-close ms-0" @click="closeModal"></button>
            </div>

            <div class="modal-body">
              <table class="table table-striped table-hover mt-4" v-if="scheduleList">
                <thead>
                  <tr>
                    <th scope="col">روز</th>
                    <th scope="col" v-for="(hour, index) in hours" :key="`hour-${index}`" class="text-center">
                      {{ hour }}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(day, index) in days" :key="`day-${index}`">
                    <td scope="row">{{ day }}</td>
                    <td scope="col" v-for="(hour, index) in hours" :key="`hour-${index}`" class="text-center">
                      <span v-if="capacityNum = checkForPresense(day, hour)">
                        <button 
                          v-if="capacityNum === 'empty'" 
                          class="btn btn-secondary" 
                          disabled
                        >
                          <span>تکمیل ظرفیت</span>
                        </button>
                        <button 
                          v-else 
                          class="btn btn-outline-primary" 
                          :disabled="!isLoggedIn"
                        >
                          <span>رزرو نوبت - ظرفیت</span>
                          <span> {{ capacityNum }} </span>
                          <span>نفر</span>
                        </button>
                      </span>
                      <span v-else>X</span>
                    </td>
                  </tr>
                </tbody>
              </table>
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
import { mapState } from 'vuex';

export default {
  props: { scheduleData: Object },
  data() {
    return {
      scheduleList: null
    }
  },
  updated() {
    this.scheduleList = this.scheduleData.data;
  },
  computed: {
    ...mapState(['isLoggedIn', 'days', 'hours'])
  },
  methods: {
    checkForPresense(day, hour) {
      let presense = false;
      let capacity = null;

      this.scheduleList.forEach(presenseObj => {
        if(presenseObj.day === day && presenseObj.hour === hour) {
          presense = true;
          capacity = presenseObj.capacity === 0 ? 'empty' : presenseObj.capacity;
        }
      });

      return presense === true ? capacity : false;
    }, 
    closeModal() {
      this.$emit('closeModal');
    }
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
    max-width: 80%;
  }

  .modal-box-enter-active, .modal-box-leave-active {
    transition: 0.5s all ease;
  }

  .modal-box-enter, .modal-box-leave-to {
    transform: translateY(-50px);
    opacity: 0;
  }
</style>