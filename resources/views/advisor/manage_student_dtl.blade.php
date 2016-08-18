 @extends('advisor.adv_master')
        
          @section('body_template')  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Manage Student 
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
                  <h3 class="box-title">Student Detail</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-10 col-sm-9">
                      <div class="pad col-md-12">                        	
                              @if(!empty($student))
                              <!-- info row -->
                              <div class="row invoice-info">
                              
                                <div class="col-sm-3 invoice-col">
                                <strong>Individual Detail</strong><br>
                                  <address>
                                    <strong>Name</strong><br>
                                    {{ $student[0]['std_fname'].' '.$student[0]['std_lname'] }}
                                    <br>
                                    <strong>Email</strong><br>
                                    {{ $student[0]['std_email'] }}<br>
                                    <strong>Graduate Year</strong><br>
                                    {{ $student[0]['std_gradYear'] }}<br>
                                    
                                  </address>
                                </div><!-- /.col -->
                                  <!--
                                <div class="col-sm-3 invoice-col">
                                 <strong>Volunteer Detail</strong><br>
                                  <address>
                                  //<strong>Service</strong><br>
                                  
                                   // <strong>Description</strong><br>
                                  
                                    <strong>Hours</strong><br>
                                    {{ $student[0]['ser_hr'].' hr'}}
                                  </address>
                                </div> --><!-- /.col -->
                                <!--
                                <div class="col-sm-3 invoice-col">
                                  <strong>Superviosr Detail</strong><br>
                                  <address>
                                        <strong>Name</strong><br>
                                        {{ $student[0]['sup_fname'].' '.$student[0]['sup_lname'] }}<br>
                                        <strong>Email</strong><br>
                                        {{ $student[0]['sup_email'] }}<br>
                                        <strong>Phone</strong><br>
                                        {{ $student[0]['sup_phone']}}
                                    </address>
                                </div> /.col -->
                                
                                <!--
                                <div class="col-sm-3 invoice-col">
                                  <strong>Organization Detail</strong><br>
                                    <address>
                                    <strong>Name</strong><br>
                                    {{ $student[0]['org_name']}}<br>
                                    <strong>Address</strong><br>
                                    {{ $student[0]['org_address'] }}<br>
                                    </address>
                                </div> /.col -->
                                <div class="pad col-md-12"> 
                                  <table class="table dataTable">
    							<thead>
    								<tr>    								
    									<th>Service Date</th>
                                        <th>Organization</th> 
                                        <th>Service Type</th> 
                                        <th>Service Description</th>   									
                                        <th>Hours</th>
                                        <th>Status</th>
                                        <th>Action</th>
    								</tr>
    							</thead>
    							<tbody>
                                    <?php $total_hr= 0;
                                          $total_accepted =0;
                                          $total_rejectd = 0; 
                                          $total_pending = 0; 
                                    ?>                                    
                                    @foreach($std_dtl as $services)                                    
    								<tr>
    									<td>{{ $services['ser_date'] }}</td>
                                        <td>{{ $services['org_name'] }}</td>
                                        <td>{{ $services['serty_name'] }}</td>
                                        <td>{{ $services['org_desc'] }}</td>       									
                                        <td> 
                                        {{ $services['ser_hr'] }}  
                                        <?php $total_hr = $total_hr + $services['ser_hr'] ;?>                                                                                
                                        </td>
                                        <td>
                                            @if($services['sers_id'] == '3' || $services['sers_id'] == null)
                                        		<label class="text-yellow">Pending</lable>
                                                <?php $total_pending = $total_pending + $services['ser_hr'] ;?> 
                                        	@elseif($services['sers_id'] == '1')
                                        		<label class="text-green">Accepted</lable>
                                                <?php $total_accepted = $total_accepted + $services['ser_hr'] ;?> 
                                        	@else
                                        		<label class="text-red">Rejected</lable>
                                                <?php $total_rejectd = $total_rejectd + $services['ser_hr'] ;?> 	
                                        	@endif
                                        </td>   
                                        <td><a href="{{ url('service_detail/'.$services['ser_id']) }}" class="btn btn-primary btn-xs">Edit</a> </td>
    								</tr>
    							    @endforeach 
    							</tbody>
    							<tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
        								<th><label>Total Pending Hours</label></th>
        								<th><label>{{ $total_pending }}</label></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
        								<th><label>Total Rejected Hours</label></th>
        								<th><label>{{ $total_rejectd }} </label></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
        								<th><label>Total Accepted Hours</label></th>
        								<th><label>{{ $total_accepted }}</label></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
        								<td><label>Grand Total Hours</label></td>
        								<td><label>{{ $total_hr }}</label></td>
                                        <td></td>
                                    </tr>    								
    							</tfoot>
    						</table>	
                                	
                                	
                                	
                                </div><!-- /.col -->
                                
                              </div><!-- /.row -->
                              @else
                              <div class="alert alert-danger">
		                    <strong>Record Not Found! contact Administrator</strong> 
		              </div>		                              
                              @endif
                              <!-- this row will not appear when printing -->
                              <div class="row no-print">
                                <div class="col-xs-12">
                                  <!-- <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Edit</button> -->
                                </div>
                              </div>
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