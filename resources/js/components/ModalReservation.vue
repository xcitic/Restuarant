<template>
  <div class="modal fade modal-ext" id="modal-reservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
          <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="w-100 mt-1 mb-1">Reservation Form</h4>
              </div>
              <!--Body-->
              <div class="modal-body">
                  <div class="md-form">
                      <input v-model="input.name" type="text" id="form22" class="form-control" required>
                      <label for="form42">Your Full Name</label>
                  </div>

                  <div class="md-form">
                      <input v-model="input.email" type="email" id="form32" class="form-control" required>
                      <label for="form34">Your Email</label>
                  </div>

                  <div class="md-form">
                      <input v-model="input.phone" type="text" id="form32" class="form-control" required>
                      <label for="form34">Your Phone Number</label>
                  </div>

                  <div class="mt-2 mb-1 md-form">
                    <input type="number" v-model="input.seats" />
                    <label for="seats">Number of seats</label>
                    <range-slider
                      class="slider mt-1"
                      min="1"
                      max="250"
                      step="1"
                      v-model="input.seats"
                      ></range-slider>

                  </div>

                  <div class='col-md-12 mb-2'>
                    <div class="">
                        <label for="datepicker" class="mb-1">Choose date and time </label>
                    </div>

                    <Datepicker format="YYYY-MM-DD H:i:s" width="100%" v-model="input.date"/>

                </div>

                  <div class="text-center">
                      <button @click="submit" data-dismiss="modal" class="btn btn-lg btn-info waves-effect" :class="status == 'loading' ? 'disabled' : ''">Send Information</button>
                      

                      <div class="call">
                          <p>Or you prefer book a table by phone? <span class="cf-phone"><i class="fa fa-phone"></i>+01 234 565 280</span></p>
                      </div>
                  </div>
              </div>
              <!--Footer-->
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-green" data-dismiss="modal">Close</button>
              </div>
          </div>
          <!--/Content-->
      </div>
  </div>

</template>

<script>
import axios from 'axios';
import Datepicker from 'vuejs-datetimepicker';
import RangeSlider from 'vue-range-slider';
import 'vue-range-slider/dist/vue-range-slider.css';


export default {

  components: {
    Datepicker,
    RangeSlider
  },

  data() {
    return {
      input: {
        name: '',
        email: '',
        phone: '',
        seats: 1,
        date: ''
      },
      status: ''
    }
  },

  methods: {
    async submit() {
      this.status = 'loading';
      let payload = this.input;

      axios.post('http://localhost:8000/reservation', payload)
            .then((response) => {
              this.flash(response.data, 'success');
            })
            .catch((err) => {
              this.flash(err, 'error');
            });



    }
  }
}
</script>

<style scoped>
.slider {
  width: 100%;
}
</style>
