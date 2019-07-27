<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function save(Request $data) {

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
        'phone' => 'required|integer',
        'people' => 'required|integer|max:4',
      ]);



      if ($validator->fails()) {
        return response([ 'errors' => $validator->errors()->all(), 422]);
      }


      // If user does not exist
      // Create a new user with a random password,
      $user = Auth::user();

      if (!$user)
      {
        $password = $this->randomPassword(8);
        $encrypted = password_hash($password, PASSWORD_DEFAULT);

        $user = new User([
          'name' => $data->name,
          'email' => $data->email,
          'password' => $encrypted,
        ]);

        $user->save();
      }
      
      // create the reservation
      if ($user)
      {
        $reservation = Reservation::create([
          'user_id' => $user->id,
          'name' => $data->name,
          'email' => $data->email,
          'phone' => $data->phone,
          'people' => $data->people,
        ]);

        $reservation->save();

        // Send email confirmation to user with reservation & user details

        return response($reservation, 200);
      }



    }


    public function delete() {

      // delete the reservation

    }


    public function show() {
      // show reservation that belongs to the user
    }


    public function modify() {

      // change the date or people coming

    }

    public function listAll() {
      // list all reservations for admins
    }


    public function randomPassword($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
      $pieces = [];
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
        $pieces [] = $keyspace[random_int(0, $max)];
      }
      return implode('', $pieces);
    }



}
