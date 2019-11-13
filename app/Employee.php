<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "companies";

    protected $fillable = ['firt_name','last_name','email','phone','company_id'];

    public function companies()
    {
        return $this->belongsTo('App\Company');
    }
}
