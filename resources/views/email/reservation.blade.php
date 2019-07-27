<html>
  <body>
    <div class="container">
      <div>
        Reservation Details:
        Name: {{ $reservation->name }}
        Phone: {{ $reservation->phone }}
      </div>

      <div>
        Login To Edit Your Reservation:
        <a href="https://restaurant.samilazreg.com">Click the link </a>
          Your username: {{ $email }}
        @if ($password)
          Your Password: {{ $password }}
        @endif
      </div>
    </div>

  </body>
</html>
