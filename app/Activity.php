<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
	protected $table = 'activity';
	
	protected $primaryKey = 'act_id';
	
	protected $fillable = ['std_id', 'spc_act_id','act_tab','act_time','act_date','act_name'];
}

