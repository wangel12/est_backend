<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationList extends Model
{
    //
    protected $table = 'notification_lists';
    
    //
    protected $primaryKey = 'nl_id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nl_title', 'nl_msg'];
}
