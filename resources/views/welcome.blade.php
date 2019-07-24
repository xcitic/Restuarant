@extends('layouts.app')

@section('content')
  <div id="vuejs">

  <header-image />
  <modal-reservation />
  <modal-contact />

</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>


<script>


  //Animation init
  new WOW().init();

  // Material Select Initialization
  $(document).ready(function() {
      $('.mdb-select').material_select();
  });

</script>
@endsection
