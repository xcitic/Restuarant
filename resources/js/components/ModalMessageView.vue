<template>
          <!--Content-->
          <div class="dialog-content" style="margin: 2rem;">

              <!--Header-->
              <div class="dialog-c-title">
                  <button type="button" class="close" @click="$emit('close')">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="w-100 mt-1 mb-3">View The Message</h4>
              </div>
              <!--Body-->
              <div class="dialog-c-text">
                <div class="md-form">
                    <i class="fa fa-user prefix"></i>
                    <input  disabled v-model="data.name" type="text" id="form22" class="form-control">
                    <label class="active" for="form42">Name</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-envelope prefix"></i>
                    <input disabled v-model="data.email" type="text" id="form32" class="form-control">
                    <label class="active" for="form34">Email</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-tag prefix"></i>
                    <input disabled v-model="data.subject" type="text" id="form32" class="form-control">
                    <label class="active" for="form34">Subject</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-pencil prefix"></i>
                    <textarea disabled v-model="data.message" type="text" id="form8" class="md-textarea"></textarea>
                    <label class="active" for="form8">Textarea</label>
                </div>

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

      axios.post(`http://localhost:8000/message/${payload.id}/update`, payload)
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
