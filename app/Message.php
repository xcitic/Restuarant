<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
      'name',
      'email',
      'subject',
      'message',
      'user_id'
    ];


    public function owner() {
      return $this->belongsTo('App\User');
    }
    
}
