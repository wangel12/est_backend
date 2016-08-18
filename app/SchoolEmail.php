<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolEmail extends Model
{
    //
    protected $table = 'school_emails';
	
	protected $primaryKey = 'id';
	
	protected $fillable = ['suffix'];
    
}
