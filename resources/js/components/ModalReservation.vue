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
                      <input type="text" id="form22" class="form-control">
                      <label for="form42">Your Full Name</label>
                  </div>

                  <div class="md-form">
                      <input type="text" id="form32" class="form-control">
                      <label for="form34">Your Email</label>
                  </div>

                  <div class="md-form">
                      <input type="text" id="form32" class="form-control">
                      <label for="form34">Your Phone Number</label>
                  </div>

                  <select class="mdb-select colorful-select dropdown-warning">
                      <option value="1">One Person</option>
                      <option value="2">Two Persons</option>
                      <option value="3">Three Persons</option>
                      <option value="4">More</option>
                  </select>

                  <div class="text-center">
                      <button class="btn btn-lg btn-info waves-effect">Send Information</button>
                      <p class="text-muted">*Some dummy text goes here.</p>

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
export default {
}
</script>

<style scoped>
</style>
