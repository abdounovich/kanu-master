<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Client extends Model
{
    protected $fillable = ['points'];

    public function appointments()
    {
        return $this->hasOneThrought(Appointment::class);
    }

  
}


