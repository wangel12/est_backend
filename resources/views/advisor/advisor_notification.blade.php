  @extends('advisor.adv_master')
 
  @section('body_template')

       <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Notification
            <small>section</small>
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
                  <h3 class="box-title">Send Notification</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                    <form method="post" action="{{ url('/advisor/notify') }}" role="form" accept-charset="UTF-8" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="pad col-md-6">
                          <label>Notification Title</label>
                          <div class="input-group">
                            <span class="input-group-addon">Title</span>
                            <input type="text" class="form-control" placeholder="" name="title" />
                          </div>
                          <br>
                          <div class="input-group">
                            <textarea  name="msg" class="form-control" rows="7" cols="100" placeholder="Write Message" ></textarea>
                          </div>
                          <hr />
                          <div class="input-group">
                          <input type="submit" class="btn btn-block btn-primary" value="Send Notification"/> 
                          </div>
                      </div>
                    </form> 
                    </div><!-- /.col -->

                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      @endsection