<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'link_message_id'
    ];

    //Set up relation to user
    public function user(){
        return $this->belongsTo('App\User');
    }

}
