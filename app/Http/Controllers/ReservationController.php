<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\User;
use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationCreated;

class ReservationController extends Controller
{

    /**
     * List the reservations, admin sees all, user sees the one it owns.
     * @return JSON array of Objects
     */
    public function index() {

      $user = Auth::user();

      if ($user->isAdmin()) {
        $reservations = Reservation::latest()->get();
      } else {
        $reservations = $user->reservations;
      }

      return response()->json($reservations, 200);

    }


    /**
     * Validate data and save to database + notify user.
     * @param  ReservationRequest $request  validate & sanitize input
     * @return JSON
     */
    public function store(ReservationRequest $request) {

      // validate the input
      // save to Database
      // Create user with random password
      // send email notification to user with reservation details and user login to change their details

      $validated = $request->validated();

      $email = $request->email;

      // If user does not exist
      // Create a new user with a random password
      if (Auth::user()) {
        $user = Auth::user();
      } else {
        $user = User::where('email', $email)->first();
      }

      $newUser = false;

      if (!$user)
      {
        $password = $this->randomPassword(8);
        $encrypted = password_hash($password, PASSWORD_DEFAULT);

        $user = new User([
          'name' => $request->name,
          'email' => $email,
          'password' => $encrypted,
        ]);

        $user->save();
        $newUser = true;
      }

      // create the reservation
      if ($user)
      {
        $reservation = Reservation::create([
          'user_id' => $user->id,
          'name' => $request->name,
          'email' => $email,
          'phone' => $request->phone,
          'seats' => $request->seats,
          'date' => $request->date,
        ]);

        $reservation->save();

        // Send email confirmation to user with reservation & user details
        try {
            if($newUser) {
              Mail::to($email)->send(new ReservationCreated($reservation, $email, $password));
            } else {
              Mail::to($email)->send(new ReservationCreated($reservation, $email));
            }

        } catch (\Exception $e) {
            return response(['message' => 'Could not send email to that address.'], 400);
        }

        return response()->json('Your reservation has been saved. Thank you. An confirmation will soon be sent to: ' . $email . '', 200);
      }


    }


    /**
     * Update a reservation
     * @param  Request $data  Input from form
     * @param  Integer  $id   Unique identifier
     * @return JSON           Success or error message
     */
    public function update(ReservationRequest $request, int $id) {


      $validated = $request->validated();

      $reservation = Reservation::where('id', $id)->first();
      $user = Auth::user();
      $reservation_owner = $reservation->owner->id;

      // Admin can edit everything, user can only edit what they own.
      if ( isset($reservation->user_id) && $user->id === $reservation->owner->id ) {
          $reservation->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'seats' => $request->seats,
            'date' => $request->date,
          ]);
      }
      elseif ($user->isAdmin()) {
        $reservation->update([
          'name' => $request->name,
          'phone' => $request->phone,
          'seats' => $request->seats,
          'date' => $request->date,
        ]);
      }
      else {
        return response()->json('Unauthorized', 401);
      }

      return response()->json('Successfully updated your reservation.', 200);

    }

    /**
     * Delete a reservation
     * @param  integer $id  Unique identifier
     * @return JSON
     */
    public function destroy(int $id) {
       $reservation = Reservation::where('id', $id)->first();
       $user = Auth::user();

       if ( isset($reservation->user_id) && $user->id === $reservation->owner->id ) {
         $reservation->delete();
       }
       elseif ($user->isAdmin()) {
         $reservation->delete();
       }
       else {
         return response()->json('Unauthorized', 401);
       }

       return response()->json('Successfully deleted reservation', 200);
    }


    /**
     * Generate a cryptographical secure password
     * @param  integer $length   Number of character length to generate
     * @param  string $keyspace  Allowed characters
     * @return string
     */
    public function randomPassword(int $length, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
      $pieces = [];
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
        $pieces [] = $keyspace[random_int(0, $max)];
      }
      return implode('', $pieces);
    }


}
