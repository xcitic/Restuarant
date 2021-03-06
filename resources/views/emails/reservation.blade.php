@component('mail::message')
# Your Reservation Mr/Mrs {{$reservation->name}}

Thank you for reserving a table at our lovely restaurant <i>Le Monde</i>.

Your reservation has been registered: <br>
Number of seats: {{$reservation->seats}} <br>
Date: {{$reservation->date}}

@if($password)
  We have created a user for you. This way you can edit your reservation anytime, and send us a message if you want to.
  <br>
  <strong>Username: {{$email}}</strong>
  <br>
  <strong>Password: {{$password}} </strong>
@endif
<br>
@component('mail::button', ['url' => config('app.url') . '/login'])
Login if you want to edit your reservation
@endcomponent

We are looking forward to creating a wonderful gastronomic experience for you,<br>
{{ config('app.name') }}
@endcomponent
