<!DOCTYPE html>
<html>
   <head>
    <meta charset="UTF-8">
    <title>Eservice | Tracker</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    {!! Html::style( asset('/backend/bootstrap/css/bootstrap.min.css') ) !!} 
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    {!! Html::style( asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ) !!} 
    
     <!-- jQuery 2.1.4  -->
    {!! Html::script( asset('backend/plugins/jQuery/jQuery-2.1.4.min.js') ) !!}
    <!--
    <script   src="https://code.jquery.com/jquery-2.2.2.min.js"   integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="   crossorigin="anonymous"></script>
    <script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>
    -->
    {!! Html::script( asset('backend/plugins/datepicker/bootstrap-datepicker.js') ) !!}
    {!! Html::style( asset('backend/plugins/datepicker/datepicker3.css') ) !!} 
    <!-- Theme style    -->
    {!! Html::style( asset('backend/dist/css/AdminLTE.min.css') ) !!} 
    
    {!! Html::style( asset('backend/dist/css/jQueryUI/jquery-ui-1.10.4.custom.min.css') ) !!} 
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load.    -->      
    {!! Html::style( asset('backend/dist/css/skins/_all-skins.min.css') ) !!} 
       

    {!! Html::script( asset('backend/plugins/datepicker_custom/jquery-ui-1.10.4.custom.min.js') ) !!}
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<style type="text/css">
<!--
.ui-datepicker-title{
   font-size: 12px !important;
   font-weight: normal !important;
   color: #444444 !important;
}
.ui_tpicker_time_label, .ui_tpicker_hour_label, .ui_tpicker_minute_label{
    font-size: 12px !important;
   font-weight: bold !important;
   color: #444444 !important;
}
.ui-datepicker-buttonpane, .ui-widget-content{
    font-size: 12px!important;
}
-->
</style>
    
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Eservice</b>Tracker</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">      
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">                   
            </ul>
          </div>

        </nav>
      </header>
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Advisor 
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
                  <h3 class="box-title">Create Advisor</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                      <div class="pad col-md-6">
                       <form method="POST" action="{{ url('/advisor/register') }}" role="form" accept-charset="UTF-8">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        	<div class="form-group">
                        		<label>First Name</label>
                        		<input class="form-control" placeholder="First name" name="fname" type="text" value="">
                        	</div>
                        	<div class="form-group">
                        		<label>Last Name</label>
                        		<input class="form-control" placeholder="Last name" name="lname" type="text" value="">
                        	</div>
                        	<div class="form-group">
                        		<label>Email address</label>
                        		<input class="form-control" placeholder="Email address" name="email" type="text" value="">
                        	</div>
                        	<div class="form-group">
                        		<label>Password</label>
                        		<input class="form-control" name="password" type="password" value="">
                        	</div>
                        		<input class="btn btn-primary" type="submit" value="Add">
                        
                        </form>
                      </div>
                    </div><!-- /.col -->
               
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      
      <!-- footer start -->  
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b></b>
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="">Eservice Tracker</a>.</strong> All rights reserved.
      </footer>
      <!-- footer end -->
      
    <!-- Bootstrap 3.3.2 JS -->    
    {!! Html::script( asset('backend/bootstrap/js/bootstrap.min.js') ) !!}
    <!-- FastClick -->
    {!! Html::script( asset('backend/plugins/fastclick/fastclick.min.js') ) !!}
    <!-- AdminLTE App -->
    {!! Html::script( asset('backend/dist/js/app.min.js') ) !!}
    <!-- Sparkline -->
    {!! Html::script( asset('backend/plugins/sparkline/jquery.sparkline.min.js') ) !!}
    <!-- jvectormap -->
    {!! Html::script( asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ) !!}
    {!! Html::script( asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ) !!}
    <!-- SlimScroll 1.3.0 -->
    {!! Html::script( asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') ) !!}
    <!-- ChartJS 1.0.1 
    {!! Html::script( asset('backend/plugins/chartjs/Chart.min.js') ) !!}
    -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes)
    {!! Html::script( asset('backend/dist/js/pages/dashboard2.js') ) !!}
     -->
    <!-- AdminLTE for demo purposes -->

    {!! Html::script( asset('backend/dist/js/demo.js') ) !!} 
    
    
  </body>
</html>