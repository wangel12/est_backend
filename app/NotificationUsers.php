<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationUsers extends Model
{
    //
    protected $table = 'notification_users';
    
    //
    protected $primaryKey = 'nu_id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nu_token', 'std_id'];
}
