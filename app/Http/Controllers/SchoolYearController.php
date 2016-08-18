<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SchoolYear;
use Redirect;


class SchoolYearController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{  
		$sch_year = SchoolYear::orderBy('sch_year','desc')->take(1)->get();
        
        $sch_year_all = SchoolYear::all();
        /**
        $data['main_tilte'] = 'Advisor Panel';
        $data['sub_title'] = "List Advisor";
        $date['advisors'] = $advisor_all;
        **/
        return view("advisor.school_year")->with('current_year',$sch_year)->with('sch_year_all',$sch_year_all);

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$sch_year = new SchoolYear();
        $sch_year->sch_year = $request->new_sch_year;
        $sch_year->is_current = true;
        $sch_year->save();
        return redirect()->route('schoolYear.index');
	}
    
    	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $sch_year = SchoolYear::find($id);
        $sch_year->delete();
        
        return redirect()->route('schoolYear.index');
	}
    
}

