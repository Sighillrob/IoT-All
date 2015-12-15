<!DOCTYPE html>
<html>
    <!-- START Head -->
    <head>
   
        <!-- START META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="pampersdry.info">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title> Admin Dashboard</title>
        
       

        <link rel="icon" type="image/ico" href="">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset('admins/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admins/css/custom-admin.css')}}" rel="stylesheet" type="text/css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
        <script src="{{asset('admins/js/validator/jquery.validate.min.js')}}"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
            .error{
                color:red;
            }
        </style>
    </head>

    <body class="skin-blue" >
        <!-- header logo: style can be found in header.less -->
        <header class="header">
         
            <!-- Header Navbar: style can be found in header.less -->
                   <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
            
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Admin</span>
                            </a>
                            <ul class="dropdown-menu">
                             
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-12 text-center">
                                        <a href="#">Admin Control</a>
                                    </div>
                                    
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="col-md-12">
                                        <a class="btn btn-default btn-flat btn-block" href="{{route('logout')}}">Log Out</a>
                                    </div>
                                   
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <ul class="sidebar-menu">
                      

                        <li id="User" title="User">
                            <a href="{{ URL::Route('userMangement')}}"><i class="fa fa-dashboard"></i> <span>User Mangement</span></a>
                        </li>

                         <li id="Upload" title="Upload">
                            <a href="{{ URL::Route('adminUploadcik')}}"><i class="fa fa-dashboard"></i> <span>Upload CIK</span></a>
                        </li>

                        <li  title="CIk">
                            <a id="CJK" href="#"><i class="fa fa-dashboard"></i> <span>View CIK</span></a>
                            <ul>

                            <li id="free_cjk" class="sub_cjk" title="Free Cjk">
                                <a href="{{ URL::Route('cikFree') }}"><i class="fa fa-dashboard"></i> <span>Free CIK</span></a>
                            </li>
                             <li id="assigned_cjk" class="sub_cjk" title="Assigned Cjk">
                                <a href="{{ URL::Route('cikAssign')}}"><i class="fa fa-dashboard"></i> <span>Assigned CIK</span></a>
                       </li>
                             <li id="all_cjk" class="sub_cjk" title="FUll List">
                                <a href="{{ URL::Route('cikFull') }}"><i class="fa fa-dashboard"></i> <span>Full CIK</span></a>
                            </li>

                            </ul>
                        </li>

                        

                         
                
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                  <section class="content-header">
                    <h1>
                        
                       
                    </h1>
                
                </section>
 
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('admins/js/AdminLTE/app.js')}}" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('admins/js/AdminLTE/demo.js')}}" type="text/javascript"></script>

        <script type="text/javascript">
             
            
        </script>

        <script>
            $(function() {

                $( "#start-date").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onClose: function( selectedDate ) {
                        $( "#end-date" ).datepicker( "option", "minDate", selectedDate );
                    }
                });
                $( "#end-date" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onClose: function( selectedDate ) {
                        $( "#start-date" ).datepicker( "option", "maxDate", selectedDate );
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#myModal").modal('show');
                $('.sub_cjk').hide();
            });

            $( "#CJK" ).click(function() {
                $('.sub_cjk').toggle();    
            });
        </script>
    </body>
    <!--/ END Body -->
</html>