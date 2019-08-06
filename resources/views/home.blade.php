@extends('layouts.app')

@section('content')

      <div id="vuejs">
        <div>
            <nav-bar-dash />
        </div>
        <div class="container">
          <div>
            <modal-reservation />
          </div>
          <div>
            <modal-contact />
          </div>

          <div class="col-md-12 mt-4">
            <div class="offset-md-4">
              <flash-message style="position:fixed; z-index:999999;"></flash-message>
            </div>

          </div>

          <div class="col-md-12">
            <section-dashboard-list />

          </div>
        </div>

      </div>

@endsection


@section('scripts')
<script>

  $(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });

</script>
@endsection
