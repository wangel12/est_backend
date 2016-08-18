@extends('advisor.adv_master') @section('body_template')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Manage Student Service
			<small>
				Section
			</small>
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
						<h3 class="box-title">
							Student Service Detail
						</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="row">
                            @if(!empty($service))
							<div class="col-md-9 col-sm-8">
								<form method="POST" action="{{ url('update_service_detail') }}" role="form" accept-charset="UTF-8">
									<div class="pad col-md-3">
										@if (count($errors) > 0)
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
												<li>
													{{ $error }}
												</li>
												@endforeach
											</ul>
										</div>
										@endif
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <label>Individual Detail</label>
										<input type="hidden" name="std_id" value="{{ $service[0]['std_id'] }}">
                                        <div class="form-group">
											<label>
												First Name
											</label>
											<input class="form-control" placeholder="First name" name="std_fname" type="text" value="{{ $service[0]['std_fname'] }}">
										</div>
										<div class="form-group">
											<label>
												Last Name
											</label>
											<input class="form-control" placeholder="Last name" name="std_lname" type="text" value="{{ $service[0]['std_lname'] }}">
										</div>
										<div class="form-group">
											<label>
												Email address
											</label>
											<input class="form-control" readonly="" placeholder="Email address" name="std_email" type="text" value="{{ $service[0]['std_email'] }}">
										</div>								
										<input class="btn btn-primary" type="submit" value="Update">
									</div>
									<div class="pad col-md-3">
                                        <label>Organization Details</label>
                                        <input type="hidden" name="org_id" value="{{ $service[0]['org_id'] }}">
										<div class="form-group">
											<label>
												Organization Name
											</label>
											<input class="form-control" placeholder="First name" name="org_name" type="text" value="{{ $service[0]['org_name'] }}">
										</div>
										<div class="form-group">
											<label>
												Organization Description
											</label>
											<input class="form-control" placeholder="Last name" name="org_desc" type="text" value="{{ $service[0]['org_desc'] }}">
										</div>
                                        <div class="form-group">
											<label>
												Location
											</label>
											<input class="form-control" placeholder="Address" name="org_address" type="text" value="{{ $service[0]['org_address'] }}">
										</div>								
									</div>
                                    <div class="pad col-md-3">
                                        <label>Supervisor Details</label>
                                        <input type="hidden" name="sup_id" value="{{ $service[0]['sup_id'] }}">
										<div class="form-group">
											<label>
												Name
											</label>
											<input class="form-control" placeholder="First name" name="sup_fname" type="text" value="{{ $service[0]['sup_fname'] }}">
										</div>
                                        <!--
										<div class="form-group">
											<label>
												Last Name
											</label>
											<input class="form-control" placeholder="Last name" name="sup_lname" type="text" value="{{ $service[0]['sup_lname'] }}">
										</div>
                                        -->
                                        <div class="form-group">
											<label>
												Email
											</label>
											<input class="form-control" placeholder="Last name" name="sup_email" type="text" value="{{ $service[0]['sup_email'] }}">
										</div>	                                   						
									</div>
									<div class="pad col-md-3">
                                        <label>Service Detail</label>
                                        <input type="hidden" name="ser_id" value="{{ $service[0]['ser_id'] }}">
										<div class="form-group">
											<label>
												Service Type
											</label>
                                            <select name="serty_id" class="form-control">
                                                 @foreach($service_type_all as $sers)
                                                 <option value="{{ $sers->serty_id }}" <?php if($sers->serty_id == $service[0]['serty_id'] ){echo 'selected';} ?> >{{ $sers->serty_name }}</option>                                                 
                                                 @endforeach   
                                            
                                            </select>
											<!-- <input class="form-control" readonly="" name="" type="text" value="$service[0]['serty_name']"> -->
										</div>
										<div class="form-group">
											<label>
												Service Hours
											</label>
											<input class="form-control"  name="ser_hr" type="text" value="{{ $service[0]['ser_hr'] }}">
										</div>
										<div class="form-group">
											<label>
												Status
											</label>
											<!-- <input class="form-control" readonly="" name="" type="text" value="{{ $service[0]['ser_stat'] }}"> -->
                                            <select name="sers" class="form-control" >
                                                <option value="1" <?php if($service[0]['ser_stat']=="Accepeted" ){echo "selected";} ?> >Accept</option>
                                                <option value="2" <?php if($service[0]['ser_stat']=="Rejected" ){echo "selected";} ?>>Reject</option>
                                                <option value="3" <?php if($service[0]['ser_stat']=="Pending" ){echo "selected";} ?>>Pending</option>
                                            </select>
										</div>
									</div>
								</form>
							</div>
                            @endif
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection