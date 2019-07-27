<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\User;
use App\Mail\ReservationCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{

    public function store(Request $data) {

      // validate the input
      //
      // save to Database
      //
      // Create user with random password
      //
      // send email notification to user with reservation details and user login to change their details


      $validator = Validator::make($data->all(), [
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:100',
        'phone' => 'required|string|max:25',
        'people' => 'required|integer|max:250',
      ]);



      if ($validator->fails()) {
        return response([ 'errors' => $validator->errors()->all(), 422]);
      }


      $email = $data->email;

      // If user does not exist
      // Create a new user with a random password,
      if (Auth::user()) {
        $user = Auth::user();
      } else {
        $user = User::where('email', $email)->first();
      }

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

        $createdUser = true;
      }

      // create the reservation
      if ($user)
      {
        $reservation = Reservation::create([
          'user_id' => $user->id,
          'name' => $data->name,
          'email' => $email,
          'phone' => $data->phone,
          'people' => $data->people,
        ]);

        $reservation->save();

        // Send email confirmation to user with reservation & user details
        // TODO
        //  Change ->send to ->queue



        // if(!$createdUser) {
        //   Mail::to($email)->send(new ReservationCreated($reservation, $email));
        // } else {
        //   Mail::to($email)->send(new ReservationCreated($reservation, $email, $password));
        // }

        return response($reservation, 200);
      }



    }


    public function delete() {

      // delete the reservation

    }


    public function show() {

      $user = Auth::user();

      if ($user->isAdmin()) {
        $reservations = Reservation::get();
      } else {
        $reservations = $user->reservations();
      }


      return response()->json($reservations);



    }


    public function modify() {

      // change the date or people coming

    }

    public function listAll() {
      // list all reservations for admins
    }



    /**
     * Generate a cryptographical secure password
     * @param  integer $length   Key length
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
