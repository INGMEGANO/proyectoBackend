<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

     protected $fillable = [
        'emp_id',
        'name_prefix',
        'middle_initial',
        'gender',
        'father_name',
        'mother_name',
        'mother_maiden_name',
        'date_of_birth',
        'date_of_joining',
        'salary',
        'ssn',
        'phone',
        'city',
        'state',
        'zip',
        
        ];

  

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

     public function manager(){
        return $this->belongsTo('App\Models\Manager');
    }
}
