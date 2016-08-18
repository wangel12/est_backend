<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SchoolEmail;

class SchoolEmailController extends Controller
{
    //    
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
        return view('advisor.school_email_create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$school_email = new SchoolEmail();
        $school_email->suffix = $request->sch_email;
                
        $school_email->save();
        
        //return view('advisor/advisor_create',['main_title'=>'Advisor Panel' ,'sub_title' => 'Register Advisor']);
        return view('advisor.school_email_create');
	}
}
