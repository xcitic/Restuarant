<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\User;
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
        $reservations = Reservation::get();
      } else {
        $reservations = $user->reservations;
      }


      return response()->json($reservations, 200);

    }


    /**
     * Validate data and save to database + notify user.
     * @param  Request $data  input from frontend
     * @return JSON
     */
    public function store(Request $data) {

      // validate the input
      //
      // save to Database
      //
      // Create user with random password
      //
      // send email notification to user with reservation details and user login to change their details


      $validateData = $data->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:100',
        'phone' => 'required|string|max:25',
        'seats' => 'required|integer|max:250',
        'date' => 'required|string|max:100',
      ]);


      $email = $data->email;

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
          'name' => $data->name,
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
          'name' => $data->name,
          'email' => $email,
          'phone' => $data->phone,
          'seats' => $data->seats,
          'date' => $data->date,
        ]);

        $reservation->save();

        // Send email confirmation to user with reservation & user details
        // TODO
        //  Change ->send to ->queue

        try {
            if($newUser) {
              Mail::to($email)->send(new ReservationCreated($reservation, $email, $password));
            } else {
              Mail::to($email)->send(new ReservationCreated($reservation, $email));
            }

        } catch (\Exception $e) {
            return $e;
        }



        // try {
        //
        // } catch (\Exception $e) {
        //   return response()->json($e, 500);
        // }


        // } else {
        //   Mail::to($email)->send(new ReservationCreated($reservation, $email, $password));
        // }

        return response()->json('Your reservation has been saved. Thank you. An confirmation will soon be sent to: ' . $email . '', 200);
      }


    }


    /**
     * Update a reservation
     * @param  Request $data  Input from form
     * @param  Integer  $id   Unique identifier
     * @return JSON           Success or error message
     */
    public function update(Request $data, $id) {


      $validateData = $data->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:100',
        'phone' => 'required|string|max:25',
        'seats' => 'required|integer|max:250',
        'date' => 'required|string|max:100',
      ]);

      $reservation = Reservation::findOrFail($id);
      $user = Auth::user();
      $reservation_owner = $reservation->owner->id;

      // Admin can edit everything, user can only edit what they own.
      if ($user->isAdmin()) {
        $reservation->update($data->all());
      }
      elseif ($user->id === $reservation_owner) {
        $reservation->update($data->all());
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
    public function destroy($id) {
       $reservation = Reservation::findOrFail($id);
       $user = Auth::user();

       $user_id = $user->id;
       $reservation_owner = $reservation->owner->id;

       if ($user->isAdmin()) {
         $reservation->delete();
       }
       elseif ($user_id === $reservation_owner) {

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
    public function randomPassword($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
      $pieces = [];
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
        $pieces [] = $keyspace[random_int(0, $max)];
      }
      return implode('', $pieces);
    }


}
