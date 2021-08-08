<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Companies extends Model
{
    use Notifiable;
    public $timestamps = true;
    
    protected $fillable = [
        'id','name','email','website','logo_url','created_at','updated_at'
    ];
}
