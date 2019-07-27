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

                    <select v-model="data.people" class="mdb-select colorful-select dropdown-warning">
                        <option value="1">One Person</option>
                        <option value="2">Two Persons</option>
                        <option value="3">Three Persons</option>
                        <option value="4">More</option>
                    </select>

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

$(document).ready(function() {
  $('.mdb-select').material_select();
});



export default {

  props: {data: Object},

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

<style scoped>
</style>
