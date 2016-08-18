<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Advisor;
use App\Student;
use App\VolunteerHour;
use App\Service;
use App\ServiceType;
use App\Activity;
use App\Organization;
use App\Supervisor;
use App\NotificationUsers;
use App\NotificationList;
use Redirect;
use Mail;

class AdvisorController extends Controller {
    private $adv_id =null;
    
    public function __construct()
    {
        if (\Auth::check())
        {
            // The user is logged in...
             $this->adv_id = \Auth::user()->adv_id;
        }       
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $advisor_all = Advisor::all();

        $data['main_tilte'] = 'Advisor Panel';
        $data['sub_title'] = "List Advisor";
        $date['advisors'] = $advisor_all;
     
        return view('advisor.advisor_list')->with('advisors', $advisor_all);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {       
          //return view('advisor/advisor_create',['main_title'=>'Advisor Panel' ,'sub_title' => 'Register Advisor']);
         
            if (\Auth::check())
            {
                // The user is logged in...
                return view('advisor.advisor_create');
            }
            else
            {
                return view('advisor.advisor_create_invite');  
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:advisors,adv_email',
        ]);
    
        $advisor = new Advisor();
        $advisor->adv_fname = $request->fname;
        $advisor->adv_lname = $request->lname;
        $advisor->adv_password = bcrypt(trim($request->password));
        $advisor->adv_email = trim($request->email);
        $advisor->is_active = true;
        
        $advisor->save();
        
        //return view('advisor/advisor_create',['main_title'=>'Advisor Panel' ,'sub_title' => 'Register Advisor']);
        
        if (\Auth::check())
        {
            // The user is logged in...
            return redirect()->route('advisor.index');           
        }
        else
        {
           return redirect()->route('advisor.index');     
          
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $advisor = Advisor::find($id);
        //var_dump($advisor);
        return view('advisor.advisor_profile')->with('advisor',$advisor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $advisor = Advisor::findOrFail($id);
        return view('advisor.advisor_edit')->with('advisor', $advisor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        //
        $advisor = Advisor::find($id);
        //$advisor_update = $request->all();
        
        $advisor_update['adv_fname'] = $request->fname;
        $advisor_update['adv_lname'] = $request->lname;
        $advisor_update['adv_email'] = $request->email; 
        if(!empty($request->password))
        {
           $advisor_update['adv_password'] = bcrypt($request->password); 
        }
        
        $advisor->update($advisor_update);
        
        return redirect()->route('advisor.index');
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
        $advisor = Advisor::find($id);
        $advisor->delete();
        
        return redirect()->route('advisor.index');
    }
    
     /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailInvitation(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',            
    ]);
        Mail::send('advisor.mails.invitation', array('test' => 'test'), function ($message){
            $message->from('info@eservicetracker.com', 'Eservice Tracker');
            $message->to(Input::get('email'))->subject('Welcome to Eservice Tracker');
        });        
        return view('advisor.advisor_invite');  
    }
    
    /**
     * Display a listing of all students.
     *
     * @return Response
     */
    public function listAllStudent()
    {
        $student_all = Student::all();

        return view('advisor.manage_student_list')->with('students', $student_all);
    }
   
   /**
     * Display detail information of a student
     * @param $id => student id 
     * @return Response
    */
   public function getStudentDetail($id =null)
   {

        $student = \DB::table('students')
            ->select('students.std_id',
            'students.std_fname',
            'students.std_lname',
            'students.std_email',
            'students.std_isActive',
            'students.std_gradYear',
            'services.ser_hr',
            'supervisors.sup_fname',
            'supervisors.sup_lname',
            'supervisors.sup_email',
            'supervisors.sup_phone',
            'organizations.org_name',
            'organizations.org_address'
           )
            ->leftJoin('services', 'services.std_id', '=', 'students.std_id')
            ->leftJoin('supervisors', 'supervisors.ser_id', '=', 'services.ser_id')
            ->leftJoin('organizations', 'services.ser_id', '=', 'organizations.org_id')
            ->where('students.std_id','=',$id)
            ->get();
            
            $student = array_map(function($object){
                return (array) $object;
            }, $student);
                        

           $student_dtl = \DB::table('services')
                    ->select( 'services.ser_hr', 
                               'services.ser_id',
                               'services.ser_date',
                               'services.sers_id',
                               'service_types.serty_name',
                               'organizations.org_name',
                               'organizations.org_desc'           
                   )
                    ->join('service_types', 'service_types.serty_id', '=', 'services.serty_id') 
                    ->join('organizations', 'services.ser_id', '=', 'organizations.ser_id')
                    //->where('sers_id','1')
                    ->where('std_id', $id) 
                    ->orderBy('sers_id', 'desc')                   
                    ->get();
            
               $student_dtl = array_map(function($object){
                return (array) $object;
            }, $student_dtl);
                                  
            //var_dump($student_dtl);
            //exit();
            return view('advisor.manage_student_dtl', ['student' => $student,'std_dtl'=>$student_dtl]);
   } 
   
    /**
     * Display list of student to manage their hour 
     * @return Response
    */
   public function listStudentHour()
   {
        /**
        $student_all = Student::all();

        foreach ($student_all as $student) {
            echo $student->vol_hours->vh_done;
        }
        **/
        
        //$student_all = Student::with('vol_hours','services')->get();
        //$student_all = Student::with('vol_hours','services')->get();
    
        $students = \DB::table('services')
            ->select(          
            'organizations.org_name',
            'organizations.org_desc',   
            'students.std_id',  
            'students.std_fname', 
            'students.std_lname',   
            'students.std_email',
            'students.std_isActive',
            'services.ser_id',
            'services.adv_id',
            'services.ser_hr',
            'services.sers_id'          
           )
            ->join('organizations', 'services.ser_id', '=', 'organizations.ser_id')
            ->join('students','services.std_id','=','students.std_id')
            ->where('services.adv_id','=',$this->adv_id)
            //->groupBy('sers_id')
            ->orderBy('sers_id', 'desc')
            ->get();
            
           
            $student_all = array_map(function($object){
                return (array) $object;
            }, $students);
        
        //var_dump($students);
        //exit();   
        
        //var_dump($student_all);
        return view('advisor.manage_volunteer_hr_list')->with('students', $student_all); 
                  
   } 
    
    /**
     * Update volunteer hour of a student
     * @return Response
    */
   public function updateStudentHour(Request $request)
   {
        $id = $request->vh_id;       
        
        $service = Service::findOrFail($id);
        
        $service_update['ser_hr'] = $request->edited_hr;
        
        $service->update($service_update);
        
        return redirect()->action('AdvisorController@listStudentHour');        
   } 
   
    /**
     * Update volunteer service status of a student
     * @return Response
    */
   public function updateServiceStatus($id=null,$status =null)
   {       
        $service = Service::findOrFail($id);
        $std_id = $service->std_id;
       
        $service_update['sers_id'] = $status;
        $service->update($service_update);
        
        $activity = new Activity();
        $activity->std_id = $service->std_id;
        $activity->spc_act_id = $service->ser_id;
        $activity->act_tab = "Services";
        $activity->act_time = date('h:i:a');
        $activity->act_date = date('Y-m-d');
        
        $student = Student::find($std_id);
        $token = $student->token;
        
        if($status == 1)
        {
            $activity->act_name = "accepted service status";
            $this->send_individual_notification("Service Status","Your submitted service info has been accepted.",$token);
        }
        else
        {
            $activity->act_name = "rejected service status";
            $this->send_individual_notification("Service Status","Your submitted service info has been rejected.",$token);
        }
        
       
        $activity->save();               
    
        
        return redirect()->action('AdvisorController@listStudentHour');       
   }   
   
    /**
     * Update student status 
     * @return Response
    */
   public function updateStudentStatus($id=null,$status =null)
   {       
        $student = Student::findOrFail($id);
       
        $student_update['std_isActive'] = $status;
        
        $student->update($student_update);
        
        return redirect()->action('AdvisorController@listAllStudent');       
   }
   
    /**
     * Display list of student by year to manage their hour 
     * @return Response
    */
   public function listStudentHourByYear(Request $request)
   {
        
        $std_year = $request->sYear;
        
        //$student_all = Student::with('vol_hours','services')->where('std_gradYear', $std_year)->get();
        $students = \DB::table('students')
            ->select('students.std_id',
            'students.std_fname',
            'students.std_lname',
            'students.std_email',
            'students.std_isActive',
            'students.std_gradYear',    
            'services.sers_id',
            'services.ser_id',
            'services.ser_hr',
            'organizations.org_name',
            'organizations.org_desc'  
           )
            ->join('services', 'services.std_id', '=', 'students.std_id') 
            ->join('organizations', 'services.ser_id', '=', 'organizations.ser_id')           
            ->where('std_gradYear', '=', $std_year)
            ->where('services.adv_id','=',$this->adv_id)
            ->get();
            
            $student_all = array_map(function($object){
                return (array) $object;
            }, $students);
        
   
        return view('advisor.manage_volunteer_hr_list')->with('students', $student_all); 
                  
   }   
   
    /**
     * Display list of student by name to manage their hour 
     * @return Response
    */
   public function searchStdByName(Request $request)
   {
        
        $std_name = $request->std_name;
        
        $students = \DB::table('students')
            ->select('students.std_id',
            'students.std_fname',
            'students.std_lname',
            'students.std_email',
            'students.std_isActive',
            'students.std_gradYear',                              
            'services.sers_id',
            'services.ser_id',
            'services.ser_hr',
            'organizations.org_name',
            'organizations.org_desc' 
           )
            ->join('services', 'services.std_id', '=', 'students.std_id')
            ->join('organizations', 'services.ser_id', '=', 'organizations.ser_id')     
            ->where('students.std_fname', 'LIKE', '%' . $std_name . '%')
            ->where('services.adv_id','=',$this->adv_id)
            ->get();
            
            $student_all = array_map(function($object){
                return (array) $object;
            }, $students);
     
        return view('advisor.manage_volunteer_hr_list')->with('students', $student_all); 
                  
   }
   
    /**
     * send notification to all users 
     * @return Response
    */
   public function send_notification(Request $request)
   {
        $msg_title = $request->title;
        $msg_body = $request->msg;
           
        $msg_list = new NotificationList();
           
        $msg_list ->nl_title= $msg_title;
        $msg_list ->nl_msg = $msg_body;
       
        $msg_list ->save();
        
        $all_users = Student::all();
      
           foreach($all_users  as $user)
           {
             $usr_token =$user->token;
             $this->send_individual_notification($msg_title,$msg_body,$usr_token);
           }


           
            /**
             $notification_data= '{
                  "tokens": ["0bbc44db010c7c799a7cfe679485a5b8d445636f"],
                  "send_to_all": true,
                  "profile": "test",
                  "notification": {
                    "title": "'.$msg_title.' ",
                    "message": "'.$msg_body.'",
                    "android": {
                      "title": "'.$msg_title.'",
                      "message": "'.$msg_body.'"
                    },
                    "ios": {
                      "title": "'.$msg_title.'",
                      "message": "'.$msg_body.' "
                    }
                  }
                }';
                **/
        /**     
         $notification_data= '{
                  "tokens": ["0bbc44db010c7c799a7cfe679485a5b8d445636f"],
                  "send_to_all": true,
                  "profile": "test",
                  "notification": {
                    "title": "'.$msg_title.' ",                
                    "android": {
                      "message": "'.$msg_title.'",                   
                    },
                    "ios": {
                      "message": "'.$msg_title.'",                   
                    }
                  }
                }';     

       //echo  $notification_data;
                    
        $url ="https://api.ionic.io/push/notifications";        
        $ch =curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI3ZDIwYjY5ZC00ZWRiLTQ2ODUtYmZhOS00ZDE0Njk4MTlmOGIifQ.HwP9IBVmPkp_9n_XEIFyLTKxxP-aMJLnrFyYyl_QCqA";
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
       // curl_setopt($ch,CURLOPT_TIMEOUT, 200);
        curl_setopt ($ch,CURLOPT_POST, 1); 
        curl_setopt ($ch,CURLOPT_POSTFIELDS, $notification_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec ($ch);
        if (curl_error($ch)) {
           echo curl_error($ch);
        }
        **/
        return view("advisor.advisor_notification");

   }  
   
   /**
     * send notification to specific user only
     * @return Response
    */
   function send_individual_notification($msg_title= null,$msg_body=null,$token=null)
   {
        $notification_data= '{
              "tokens": ["'.$token.'"],     
              "profile": "test",
              "notification": {
                "title": "'.$msg_title.' ",
                "message": "'.$msg_body.'",
                "android": {
                  "title": "'.$msg_title.'",
                  "message": "'.$msg_body.'"
                },
                "ios": {
                  "title": "'.$msg_title.'",
                  "message": "'.$msg_body.' "
                }
              }
            }';
    
        $url ="https://api.ionic.io/push/notifications";        
        $ch =curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI3ZDIwYjY5ZC00ZWRiLTQ2ODUtYmZhOS00ZDE0Njk4MTlmOGIifQ.HwP9IBVmPkp_9n_XEIFyLTKxxP-aMJLnrFyYyl_QCqA";
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
       // curl_setopt($ch,CURLOPT_TIMEOUT, 200);
        curl_setopt ($ch,CURLOPT_POST, 1); 
        curl_setopt ($ch,CURLOPT_POSTFIELDS, $notification_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec ($ch);
        if (curl_error($ch)) {
           echo curl_error($ch);
    }
   }
   
   /**
     * Display all data related to service and studend 
     * @return Response
    */
   public function dispaly_aggregate_edit_form($id=null)
   {      
        $std_ser_dtl = \DB::table('services')
            ->select('students.std_id',
            'students.std_fname',
            'students.std_lname',
            'students.std_email',
            'students.std_isActive',
            'students.std_gradYear',                              
            'services.sers_id',
            'services.ser_id',
            'services.ser_hr',
            'services.serty_id',
            'organizations.org_id',
            'organizations.org_name',
            'organizations.org_desc',
            'organizations.org_address',
            'supervisors.sup_id',
            'supervisors.sup_fname',
            'supervisors.sup_lname',
            'supervisors.sup_email',
            'supervisors.sup_phone',
            //'service_types.serty_name',
            'service_statuses.ser_stat' 
           )
            ->join('students', 'students.std_id', '=', 'services.std_id')
            ->join('organizations', 'services.ser_id', '=', 'organizations.ser_id')     
            ->join('supervisors', 'supervisors.ser_id', '=', 'services.ser_id') 
            //->join('service_types', 'service_types.serty_id', '=', 'services.serty_id') 
            ->join('service_statuses', 'service_statuses.sers_id', '=', 'services.sers_id')            
            ->where('services.ser_id',$id)
            ->get();
            
            $std_ser_dtl = array_map(function($object){
                return (array) $object;
            }, $std_ser_dtl);
            
            
            $service_type_all = ServiceType::all();
                   
        return view('advisor.aggregate_edit_form')->with('service', $std_ser_dtl)->with('service_type_all', $service_type_all); 
                  
   }
   
   
   /**
     * Display all data related to service and studend 
     * @return Response
    */
   public function update_aggregate_edit_form(Request $request)
   {                      
           
        $std_id = $request->std_id;
        $student = Student::find($std_id);
        $student_update['std_fname'] = $request->std_fname;
        $student_update['std_lname'] = $request->std_lname;
        //$student_update['std_email'] = $request->std_email; 
        
        $student->update($student_update);
        
        $org_id = $request->org_id;        
        $org = Organization::find($org_id);
        $org_update['org_name'] = $request->org_name;
        $org_update['org_desc'] = $request->org_desc;
        $org_update['org_address'] = $request->org_address;
        $org->update($org_update);
       
        $sup_id = $request->sup_id;
        $supervisor = Supervisor::find($sup_id);
        $supervisor_update['sup_fname'] = $request->sup_fname;
        //$supervisor_update['sup_lname'] = $request->sup_lname;
        $supervisor_update['sup_email'] = $request->sup_email;
        
        $supervisor->update($supervisor_update);
        
        $ser_id = $request->ser_id;
        $service = Service::find($ser_id);
        $service_update['ser_hr'] = $request->ser_hr;
        $service_update['serty_id'] = $request->serty_id;
        $service->update($service_update);
 
        return redirect()->back();  
              
   }
   /** Display all data related to service and studend  **/
   
   /**
     * Function to delete selected student  
     * @return Response
    */
   function destroy_student($id)
   {
        $student = Student::find($id);
        $student->delete();
        
        return redirect()->action('AdvisorController@listAllStudent');   
    
   }
   /** Function to delete selected student **/
}