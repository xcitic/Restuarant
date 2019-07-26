<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Le Monde Restuarant</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/material.min.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css')}}">
    <style media="screen">
      #scrollToTop {
      display: inline-block;
      background-color: lightblue;
      width: 50px;
      height: 50px;
      text-align: center;
      border-radius: 4px;
      position: fixed;
      bottom: 30px;
      right: 30px;
      transition: background-color .3s,
        opacity .5s, visibility .5s;
      opacity: 0;
      visibility: hidden;
      z-index: 1000;
      }
      #scrollToTop::after {
      content: "\f077";
      font-family: FontAwesome;
      font-weight: normal;
      font-style: normal;
      font-size: 2em;
      line-height: 50px;
      color: #fff;
      }
      #scrollToTop:hover {
      cursor: pointer;
      background-color: #333;
      }
      #scrollToTop:active {
      background-color: #555;
      }
      #scrollToTop.show {
      opacity: 1;
      visibility: visible;
      }

    </style>

</head>

<body class="intro-page restaurant-lp">
  <a id="scrollToTop"></a>
    <div id="vuejs">
      <header>
        <div>
            <nav-bar />
        </div>
        <div>
          <section-top />
        </div>
        <div>
          <modal-reservation />
        </div>
        <div>
          <modal-contact />
        </div>
      </header>

      <main>
        <div>
          <section-about />
        </div>

          <div>
              <section-streak />
          </div>

          <div>
            <section-menu />
          </div>

          <div>

            <hr class="between-sections">
          </div>

          <div>
            <section-products />
          </div>

          <div>
            <section-streak-2 />
          </div>

          <div>
            <section-menu-table />
          </div>

          <div>
            <section-pictures />
          </div>

          <hr class="between-sections mt-3">
          <div>
            <section-reviews />
          </div>

      </main>
      <section-footer />
          @yield('content')
    </div>


  <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>

  <!-- Bootstrap tooltips -->
  <script src="{{asset('js/tether.min.js')}}"></script>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>

  <!-- MDB core JavaScript -->
  <script src="{{asset('js/material.min.js')}}"></script>


  <script>
      //Animation init
      new WOW().init();

      //Modal
      $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
      })

      // Material Select Initialization
      $(document).ready(function() {
          $('.mdb-select').material_select();
      });

  </script>


  <script src="{{ mix('js/app.js') }}"></script>

  <script>
    let btn = $('#scrollToTop');

    $(window).scroll(function() {
      if($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>
</body>
</html>
