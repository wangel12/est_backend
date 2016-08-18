 @extends('advisor.adv_master')
        <style>
            td.custom_edit_btn:hover .btn_hide{
                visibility: visible;
            }
            
            a.btn_hide{
                  visibility: hidden;
            }
        
        
        </style>
          @section('body_template')  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Manage Volunteer Hours 
            <small>Section</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">       

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">List Student </h3>
                </div><!-- /.box-header -->
                
                <div class="box-body no-padding">
                  <div class="row">
                    <br />
                    <div class="col-md-10 col-sm-9 clearfix">
                      <div class="col-md-4 ">
                        <div class="form-group">
                            <form method="POST" action="{{ url('/advisor/manage_volunteer_hour') }}" role="form" accept-charset="UTF-8">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label>Filter by Year</label>
                            <input class="form-control" placeholder="Year (e.g. 2014)" name="sYear" type="text" value="">
                                <br />
                                <input class="btn btn-primary btn-xs" name="search" type="submit" value="Search">
                            </form>
                      </div>
                      </div>  
                      <div class="pad col-md-12">                         
                            <table class="table" id="manage_vol_hr" >
                  <thead>
                    <tr>                    
                      <th>Name</th>
                                        <th>Service</th>
                                        <th>Service Description</th>
                                        <th>Work Hour</th>
                      <th>Active</th>
              <th>Status</th>
                                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                                    <?php $counter = 1;
                                    ?>
                                    @foreach($students as $student)       
                                    <tr>
                      <td><a href="{{ url('advisor/student_detail/'.$student['std_id'] ) }}" >{{ $student['std_fname']." ".$student['std_lname'] }} </a></td>
                                         
                                        <td>{{ $student['org_name'] }} </td>
                                        <td>{{ $student['org_desc'] }} </td>
                                    
                                        <td class="custom_edit_btn">{{ $student['ser_hr']}} 
                                            <a href="#" class="btn btn-primary btn-xs btn_hide" data-toggle="modal" data-target="#edit_hours_{{ $student['ser_id'] }}">Edit</a>
                                        </td>
                                           
                      <td>@if ($student['std_isActive'] == true)
                                                <img src="{{ asset('backend/dist/img/yes.png') }}" class="img-circle" alt="true"/> 
                                            @else 
                                                <img src="{{ asset('backend/dist/img/x.png') }}" class="img-circle" alt="true" /> 
                                            @endif
                                        </td>
                                        <td>
                                          @if($student['sers_id'] == '3' || $student['sers_id'] == null)
                                            <label class="text-yellow">Pending</lable>
                                          @elseif($student['sers_id'] == '1')
                                            <label class="text-green">Accepted</lable>
                                          @else
                                            <label class="text-red">Rejected</lable>  
                                          @endif 
                                        </td>
                                        <td>
                                           <!-- @if($student['sers_id'] == '3' || $student['sers_id'] == '2' || $student['sers_id'] == null)
                                                <a class="btn btn-primary  btn-xs" href="{{ url('advisor/update_service_status/'. $student['ser_id'].'/1') }}">Accept</a>
                                            @else
                                                <a class="btn btn-danger  btn-xs" href="{{ url('advisor/update_service_status/'.$student['ser_id'].'/2') }}">Reject</a>   
                                            @endif        
                                            --> 
                                            <a class="btn btn-primary  btn-xs" href="{{ url('advisor/update_service_status/'. $student['ser_id'].'/1') }}">Accept</a> |  
                                            <a class="btn btn-danger  btn-xs" href="{{ url('advisor/update_service_status/'.$student['ser_id'].'/2') }}">Reject</a>                                                                                                                                                      
                                        </td>
                                       
                                        <!-- Model .................................................................................  --> 
                                        <div class="modal fade" id="edit_hours_{{ $student['ser_id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-custom">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Edit Hour of: <strong>{{ $student['std_fname']." ".$student['std_lname'] }} </strong></h4>
                                              </div>
                                              <div class="modal-body" style="overflow-x: auto;">
                                                <form action="{{ url('advisor/update_volunteer_hour') }}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <label>Work Hour: </label>
                                                    <input type="text" name="edited_hr" value="{{ $student['ser_hr'] }} "/>
                                                    <input type="hidden" name="vh_id" value="{{ $student['ser_id'] }} "/>
                                                    <input type="submit" class="btn btn-primary  btn-xs" /> 
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <!-- Model ................................................................................. -->
                    </tr>
                      @endforeach 
                                   
                  </tbody>
                </table>
                      </div>
                    </div><!-- /.col -->
               
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->    
      @endsection
      
    <!-- DATATABLE RELATED CODE START -->
    <!-- jQuery 2.1.4 -->
    {!! Html::script( asset('backend/plugins/jQuery/jQuery-2.1.4.min.js') ) !!}
    
    <!-- bootstrap datatables -->
    {!! Html::style( asset('backend/plugins/datatables/dataTables.bootstrap.css') ) !!}
      
    <!-- DATA TABES SCRIPT -->
    {!! Html::script( asset('backend/plugins/datatables/jquery.dataTables.min.js') ) !!}
    {!! Html::script( asset('backend/plugins/datatables/dataTables.bootstrap.min.js') ) !!}
    <!-- DATATABLE RELATED CODE END -->
    
    <script type="text/javascript">
      var $j = jQuery.noConflict();
      
      /** implementing datatables**/
      $j(function () {
        $j("#manage_vol_hr").dataTable();
      });
    </script>