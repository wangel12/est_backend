<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model {

	//
    protected $table = 'organizations';
    
    //
    protected $primaryKey = 'org_id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['org_name', 'org_address','org_desc'];

}