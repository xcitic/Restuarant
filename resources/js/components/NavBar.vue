<template>
  <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar">

      <div class="container">

          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <a class="navbar-brand" href="/">
              <strong>Le Monde</strong>
          </a>

          <div class="collapse navbar-collapse" id="navbarNav">

              <!--Links-->
              <ul class="navbar-nav mr-auto smooth-scroll">
                  <li class="nav-item">
                      <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#about" data-offset="100">About</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#intro" data-offset="100">Intro</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#specials" data-offset="100">Specials</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#menu" data-offset="100">Menu</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#testimonials" data-offset="100">Opinions</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="modal" data-target="#modal-contact">Contact</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="modal" data-target="#modal-reservation">Reserve Now</a>
                  </li>
              </ul>

              <!--Social Icons-->
              <ul class="navbar-nav nav-flex-icons">
                  <li class="nav-item">
                      <a class="nav-link"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link"><i class="fa fa-instagram"></i></a>
                  </li>
                  <li class="nav-item ml-2">
                      <a class="nav-link" @click="redirectLogin">Login</a>
                  </li>
              </ul>

          </div>
      </div>
  </nav>
</template>

<script>
    export default {
      methods: {
        redirectLogin() {
          window.location.assign('/login');
        }
      }
    }
</script>
