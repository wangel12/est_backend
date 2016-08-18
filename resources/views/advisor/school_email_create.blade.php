 @extends('advisor.adv_master')
        @section('body_template')  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           School Email 
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
                  <h3 class="box-title">Create School Email</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                      <div class="pad col-md-6">
                        {!! Form::open(array('url' => 'school_email')) !!}
                                <div class="form-group">
                                    <label>School Email Suffix</label>
                                    {!! Form::text('sch_email', '' ,['class' => 'form-control', 'placeholder' => '@schoolmail.com']) !!}
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