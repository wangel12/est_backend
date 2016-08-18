<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model {

	//
    protected $table = 'supervisors';
    
    //
    protected $primaryKey = 'sup_id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sup_fname', 'sup_lname','sup_email'];


}