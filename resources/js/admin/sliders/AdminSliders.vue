<template>
  <div class="container py-4 admin-sliders">
    <div class="page-title d-flex justify-content-between">
      <h3>اسلاید‌ها</h3>

      <button 
        class="btn btn-success" 
        @click="showingModal"
      >
        اسلاید جدید
      </button>

    </div>
    <hr>
    <alert 
      :alertData="alertData"
    ></alert>
    <slider-create
      @alertShow="alertShow"
      @showingModal="showingModal"
      @newSliderAdded="newSliderAdded"
      @sliderUpdated="sliderUpdated"
      :showModal="showModal"
      :sliderUpdate="sliderUpdate"
    ></slider-create>

    <loading v-if="loading"></loading>
    <div v-else>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">پیش ‌نمایش</th>
            <th scope="col">نام تصویر</th>
            <th scope="col">تاریخ ایجاد</th>
            <th scope="col">ویرایش/حذف</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(slider, index) in sliders" :key="`slider-${index}`">
            <th scope="row">{{ ++index }}</th>
            <td>
              <img width="120" :src="`/images/sliders/${slider.image}`">
            </td>
            <td>{{ slider.name }}</td>
            <td>{{ slider.updated_at }}</td>
            <td>
              <!-- Update slide btn -->
              <button 
                class="bg-transparent border-0" 
                @click="showingModalUpdate(slider.id, slider.name, slider.image)"
              >
                <i class="fas fa-edit fa-lg text-info"></i>
              </button>
              <!-- Delete slide btn -->
              <button 
                class="bg-transparent border-0 me-3" 
                @click.prevent="deleteSlide(slider.id)"
              >
                <i class="fas fa-trash fa-lg text-danger"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import SliderCreate from './SliderCreate';

export default {
  components: { SliderCreate },
  data() {
    return {
      loading: false,
      sliders: null,
      alertData: {
        show: false,
        message: null
      },
      showModal: false,
      sliderUpdate: {
        id: null,
        name: null,
        image: null,
      },
    }
  },
  created() {
    this.loading = true;

    axios.get('/api/admin/sliders')
      .then(response => {
        this.sliders = response.data.data;
      })
      .then(this.loading = false);
  },
  methods: {
    deleteSlide(slider) {
      axios.delete(`/api/admin/sliders/${slider}`)
        .then(response => {
          // Show Success alert
          this.alertData = {
            show: true,
            message: response.data.message
          };
          // reRendered sliders item
          this.sliders = response.data.sliders;
      });
    },
    alertShow(event) {
      this.alertData = {
        show: true,
        message: event
      };
    },
    showingModal() {
      this.showModal = !this.showModal;
    },
    showingModalUpdate(slider_id, slider_name, slider_image) {
      this.showingModal();
      this.sliderUpdate = {
        id: slider_id,
        name: slider_name,
        image: slider_image
      }
    },
    newSliderAdded(slider) {
      this.sliders.push(slider);
    },
    sliderUpdated(updateSlider) {
      // Add updated slider to the DOM
      this.sliders = this.sliders.map(slider => {
        return (slider.id === updateSlider.id) ? updateSlider : slider;
      });

      // Reset slider update data
      this.sliderUpdate = {
        id: null,
        name: null,
        image: null
      }
    }
  }
}
</script>
