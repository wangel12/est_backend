<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    //
    protected $table = 'students';
    
    protected $primaryKey = 'std_id';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['std_isActive','std_fname','std_lname','std_email'];
    
    /**
     * Get the volunteer hours  for the student post.
     */
    public function vol_hours()
    {
         //return $this->belongsTo('App\VolunteerHour','std_id');
         return $this->hasMany('App\VolunteerHour', 'std_id');
    }
    
    /**
     * Get the volunteer hours  for the student post.
    */ 
    public function services()
    {
         //return $this->belongsTo('App\Service','std_id');
         return $this->hasMany('App\Service', 'std_id');
    }
    
    
    /**
     * Get volunteer hour and service of the student.
     */
    public function service_hours()
    {
        return $this->hasManyThrough('App\ServiceStatus','App\Service' ,'std_id','sers_id');
    }
    
    
    

}
