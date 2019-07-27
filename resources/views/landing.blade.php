@extends('layouts.app')

      @section('content')
        <div id="vuejs">
          <header>
            <div>
                <nav-bar />
            </div>
            <div>
              <flash-message></flash-message>
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
        </div>
      @endsection


@section('scripts')
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

@endsection
