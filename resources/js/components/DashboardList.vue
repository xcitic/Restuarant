<template>
  <div class="col-md-12">

    <div class="row">
        <div class="col-md-12 mb-1">
            <!-- Tabs -->
            <!-- Nav tabs -->

            <div class="tabs-wrapper ">
                <ul class="nav classic-tabs tabs-primary primary-color" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link waves-light active waves-effect waves-light" data-toggle="tab" href="#panel83" role="tab">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-light waves-effect waves-light" data-toggle="tab" href="#panel84" role="tab">Messages</a>
                    </li>

                </ul>

            </div>
            <!-- Tab panels -->
            <div class="tab-content card">
                <!--Panel 1-->
                <div class="tab-pane fade show active" id="panel83" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Seats</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="(item, key) in reservations">
                                    <th scope="row">{{item.id}}</th>
                                    <td>{{item.name}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.updated_at}}</td>
                                    <td>{{item.people}}</td>
                                    <td>{{item.date}}</td>
                                    <td>
                                        <a class="blue-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="See results"><i class="fa fa-user"></i></a>
                                        <a class="teal-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a @click="removeReservation(item.id)" class="red-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/.Panel 1-->
                <!--Panel 2-->
                <div class="tab-pane fade" id="panel84" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>From</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Sent At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, key) in messages">
                                    <th scope="row">{{item.id}}</th>
                                    <td>{{item.name}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.subject}}</td>
                                    <td>{{item.message}}</td>
                                    <td>{{item.created_at}}</td>
                                    <td>
                                        <a class="blue-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="See results"><i class="fa fa-user"></i></a>
                                        <a class="teal-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a @click="removeMessage(item.id)" class="red-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/.Panel 2-->
            </div>
            <!-- /.Tabs -->
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {

  data() {
    return {

      reservations: [],
      messages: [],
      search: '',

    }
  },

  mounted() {
    this.fetchReservations();
    this.fetchMessages();
  },

  methods: {
    fetchReservations() {
      axios.get('http://localhost:8000/reservations/get')
            .then(({data}) => {
              this.reservations = data;
            });
    },

    fetchMessages() {
      axios.get('http://localhost:8000/messages/get')
          .then(({data}) => {
            this.messages = data;
          });
    },

    removeReservation(id) {
      axios.post(`http://localhost:8000/reservation/${id}/delete`)
            .then((response) => {
              console.log(response);
              this.fetchReservations();
            })
    },

    removeMessage(id) {
      axios.post(`http://localhost:8000/message/${id}/delete`)
            .then((response) => {
              console.log(response);
              this.fetchMessages();
            });
    },

  }
}
</script>

<style>
</style>
