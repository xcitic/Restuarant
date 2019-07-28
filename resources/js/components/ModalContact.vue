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
                      <input v-model.trim="input.name" v-validate="'required|alpha_spaces|min:4|max:50'" id="name" name="name" type="text" class="form-control">
                      <label for="name">Your name</label>
                      <div v-if="submitted && errors.has('name')" class="invalid-feedback">
                        {{ errors.first('name') }}
                      </div>
                  </div>

                  <div class="md-form">
                      <i class="fa fa-envelope prefix"></i>
                      <input v-model.trim="input.email" v-validate="'required|email|max:50'" name="email" id="email" type="email" class="form-control">
                      <label for="email">Your email</label>
                      <div v-if="submitted && errors.has('email')" class="invalid-feedback">
                        {{ errors.first('email') }}
                      </div>
                  </div>

                  <div class="md-form">
                      <i class="fa fa-tag prefix"></i>
                      <input v-model.trim="input.subject" v-validate="'required|alpha_spaces|max:150'" name="subject" type="text" id="subject" class="form-control">
                      <label for="subject">Subject</label>
                      <div v-if="submitted && errors.has('subject')" class="invalid-feedback">
                        {{ errors.first('subject') }}
                      </div>
                  </div>

                  <div class="md-form">
                      <i class="fa fa-pencil prefix"></i>
                      <textarea v-model.trim="input.message" v-validate="'required|alpha_spaces|max:255'" name="message" type="text" id="message" class="md-textarea"></textarea>
                      <label for="textarea">Textarea</label>
                      <div v-if="submitted && errors.has('message')" class="invalid-feedback">
                        {{ errors.first('message') }}
                      </div>
                  </div>

                  <div class="text-center">
                      <button @click="submit" :data-dismiss="complete ? 'modal' : ''" class="btn btn-lg btn-info waves-effect">Submit</button>

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
      },
      complete: false,
      submitted: false,
    }
  },

  methods: {
    async submit() {
      this.submitted = true;
      this.$validator.validate().then(
        valid => {
          if (valid) {
            let payload = this.input;
            this.complete = true;

            axios.post('http://localhost:8000/message', payload)
                  .then((response) => {
                    this.flash(response.data, 'success');
                  })
                  .catch((err) => {
                    this.flash(err, 'error');
                  });
          }
        }
      )

    },

  }
}
</script>

<style scoped>
</style>
