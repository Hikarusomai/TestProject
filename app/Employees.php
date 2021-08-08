<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Companies;

class Employees extends Model
{   
    public $timestamps = true;

    protected $fillable = [
        'id','first_name','last_name', 'company_id', 'email','phone','created_at','updated_at'
    ];

    public function company()
    {
        return $this->hasOne(Companies::class,'id','company_id');
    }
}
