         @extends('advisor.adv_master')
        @section('body_template')  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Hour Setting 
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
                  <h3 class="box-title">Create Setting</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                      <div class="pad col-md-6">
                            <div class="form-group">
                                    <label>Current Hour</label>
                                    <input type="text" class="form-control" placeholder="" name="" value="25" disabled/>
                            </div>
                        {!! Form::open(array('url' => 'setting')) !!}
                                <!-- <div class="form-group">
                                    <label>Service Type</label>
                                    <select class="form-control" name="serty_id">
                                        @foreach($service_types as $service_type)
                                            <option value="{{ $service_type->serty_id}}">{{ $service_type->serty_name}}</option>
                                        @endforeach
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label>Set New Hour</label>
                                    {!! Form::text('hour', '' ,['class' => 'form-control', 'placeholder' => 'hour']) !!}
                                </div>                                                             
                                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                            
                        {!! Form::close() !!}
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