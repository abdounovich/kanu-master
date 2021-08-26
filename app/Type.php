<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['type','photo','temps','prix','point'];

    public function appointments()
    {
        return $this->hasOneThrought(Appointment::class);
    }
}
