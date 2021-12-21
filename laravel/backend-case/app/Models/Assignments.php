<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $fillable=['worked_hours','detail'];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
