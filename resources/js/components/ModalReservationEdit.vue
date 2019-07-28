<template>
          <!--Content-->
          <div class="dialog-content" style="margin: 2rem;">

              <!--Header-->
              <div class="dialog-c-title">
                  <button type="button" class="close" @click="$emit('close')">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="w-100 mt-1 mb-3">Update Your Reservation</h4>
              </div>
              <!--Body-->
              <div class="dialog-c-text">
                  <div class="md-form">
                      <input v-model="data.name" type="text" id="form22" class="form-control">
                      <label for="form42" class="active">Name</label>
                  </div>

                  <div class="md-form">
                      <input disabled v-model="data.email" type="text" id="form32" class="form-control">
                      <label for="form34" class="active">Email</label>
                  </div>

                  <div class="md-form">
                      <input v-model="data.phone" type="text" id="form32" class="form-control">
                      <label for="form34" class="active">Phone</label>
                  </div>

                  <div class="mt-2 mb-1 md-form">
                    <input type="number" v-model="data.seats" />
                    <label for="seats" class="active">Number of seats</label>
                    <range-slider
                      class="slider mt-1"
                      min="1"
                      max="250"
                      step="1"
                      v-model="data.seats"
                      ></range-slider>

                  </div>

                  <div class='col-md-12 mb-2'>
                    <div class="">
                        <label for="datepicker" class="mb-1">Choose date and time </label>
                    </div>

                    <DatePicker format="YYYY-MM-DD H:i:s" width="auto" class="date-imbedded" v-model="data.date"/>

                </div>

              </div>


              <!--Footer-->
              <div class="vue-dialog-buttons">
                  <button type="button" class="btn btn-light-green" @click="update">Update</button>
              </div>
          <!--/Content-->
      </div>

</template>

<script>
import axios from 'axios';
import DatePicker from 'vuejs-datetimepicker';
import RangeSlider from 'vue-range-slider';
import 'vue-range-slider/dist/vue-range-slider.css';



export default {

  props: {data: Object},

  components: {
    DatePicker,
    RangeSlider
  },

  methods: {

    hide() {
      this.$modal.hide('editReservation');
    },

    async update() {
      this.status = 'loading';
      let payload = this.data;

      axios.post(`http://localhost:8000/reservation/${payload.id}/update`, payload)
            .then((response) => {
              this.$emit('close');
              this.flash(response.data, 'success');
            })
            .catch((err) => {
              this.flash(err, 'error');
            });

    }
  }
}
</script>

<style>
.slider {
  width: 100%
}

/* .date-imbedded {
  left: auto;
  position: fixed !important;
  z-index: 9998;
  top: auto;
} */
</style>
