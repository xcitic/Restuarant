@extends('layouts.app')

      @section('content')
        <div id="vuejs">

          {{-- <div class="container-fluid">
            <div class="col-md-12">
              <div class="offset-md-4">
                <flash-message style="position:fixed; z-index:999999;" class="text-center"></flash-message>
              </div>
            </div>
          </div> --}}

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

            <!-- Flash messaging -->
            <div class="container-fluid">
              <div class="col-md-12">
                <div class="offset-md-4">
                  <flash-message style="position:fixed; z-index:999999; top:0;" class="text-center"></flash-message>
                </div>
              </div>
            </div>
          <!--/Flash Messaging -->

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

  </script>

@endsection
