<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";

    protected $fillable = ['name','email','website','logo'];

    public function employees()
    {
        return $this->belongsTo('App\Employee');
    }
}