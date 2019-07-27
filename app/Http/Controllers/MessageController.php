<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();

      if($user->isAdmin()) {
        $messages = Message::get();
      } else {
        $messages = $user->messages();
      }

      return response()->json($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:75',
          'email' => 'required|email|max:75',
          'subject' => 'required|string|max:255',
          'message'=> 'required|string|max:750',
        ]);

        if($validator->fails()) {
          return response([ 'errors' => $validator->errors()->all(), 422]);
        }



        $emailExists = \App\User::where('email', $request->email)->first();

        if($emailExists) {
          $userId = $emailExists->id;
        } else {
          $userId = null;
        }

        $message = Message::create([
          'name'=> $request->name,
          'email'=> $request->email,
          'subject' => $request->subject,
          'message' => $request->message,
          'user_id' => $userId
        ]);

        $message->save();

        return response()->json('Successfully sent message', 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $user = Auth::user();


        if($user->isAdmin() ) {
          $message->delete();
        }
        elseif ( $user->id === $message->user_id) {
          $message->delete();
        }
        else {
          return response()->json('Unauthorized', 401);
        }

        return response()->json('Successfully deleted message', 200);
    }
}
