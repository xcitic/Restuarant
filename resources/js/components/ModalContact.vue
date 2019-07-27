<template>
  <div class="modal fade modal-ext" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <!--Content-->
          <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="w-100" id="myModalLabel">Write to us</h4>
              </div>
              <!--Body-->
              <div class="modal-body">
                  <p>Tell us what is on your mind</p>
                  <br>
                  <div class="md-form">
                      <i class="fa fa-user prefix"></i>
                      <input v-model="input.name" type="text" id="form22" class="form-control">
                      <label for="form42">Your name</label>
                  </div>

                  <div class="md-form">
                      <i class="fa fa-envelope prefix"></i>
                      <input v-model="input.email" type="text" id="form32" class="form-control">
                      <label for="form34">Your email</label>
                  </div>

                  <div class="md-form">
                      <i class="fa fa-tag prefix"></i>
                      <input v-model="input.subject" type="text" id="form32" class="form-control">
                      <label for="form34">Subject</label>
                  </div>

                  <div class="md-form">
                      <i class="fa fa-pencil prefix"></i>
                      <textarea v-model="input.message" type="text" id="form8" class="md-textarea"></textarea>
                      <label for="form8">Textarea</label>
                  </div>

                  <div class="text-center">
                      <button @click="submit" data-dismiss="modal" class="btn btn-lg btn-info waves-effect">Submit</button>

                      <div class="call">
                          <p>Or would you prefer to call? <span class="cf-phone"><i class="fa fa-phone"></i>+01 234 565 280</span></p>
                      </div>
                  </div>
              </div>
              <!--Footer-->
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-green waves-effect" data-dismiss="modal">Close</button>
              </div>
          </div>
          <!--/Content-->
      </div>
  </div>

</template>

<script>
import axios from 'axios';

export default {

  data() {
    return {
      input: {
        name: '',
        email: '',
        subject: '',
        message: ''
      }
    }
  },

  methods: {
    async submit() {
      let payload = this.input;

      axios.post('http://localhost:8000/message', payload)
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
</style>
