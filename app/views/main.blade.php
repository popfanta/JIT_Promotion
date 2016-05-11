<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset =SET NAMES 'tis620'" />
    <title>{{ iconv('UTF-8','TIS-620','Promotion') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{ HTML::style('TemplateAdmin/bootstrap/css/bootstrap.min.css') }}
    <!-- Font Awesome Icons -->

    {{ HTML::style('TemplateAdmin/font-awesome-4.3.0/css/font-awesome.css') }}
    <!-- Ionicons -->
    {{ HTML::style('TemplateAdmin/ionicons.min.css') }}
    {{ HTML::style('TemplateAdmin/dist/css/AdminLTE.css') }}
 	{{ HTML::style('TemplateAdmin/dist/css/skins/_all-skins.min.css') }}
  {{ HTML::style('TemplateAdmin/plugins/jQueryUI/jquery-ui-1.10.4.custom.css') }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('header')
  </head>
  <body class="sidebar-mini skin-blue-light">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url() }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Promo</b>tion</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
        
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
             <li><a href="{{ url() }}"><i class="fa fa-plus"></i> <span>ข้อมูลขาย</span></a></li>
             <li><a href="{{ url('Target') }}"><i class="fa fa-crosshairs"></i> <span>Target</span></a></li>
            <li><a href="{{ url('Report') }}"><i class="fa fa-signal"></i> <span>Report</span></a></li>
            <li><a href="{{ url('ReportCompare') }}"><i class="fa fa-pie-chart"></i> <span>Report เปรียบเทียบ</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015</strong> All rights reserved.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->
    {{ HTML::script('TemplateAdmin/plugins/jQuery/jQuery-1.12.0.min.js') }}
    {{ HTML::script('TemplateAdmin/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script('TemplateAdmin/plugins/slimScroll/jquery.slimscroll.min.js') }}
    {{ HTML::script('TemplateAdmin/plugins/fastclick/fastclick.min.js') }}
    {{ HTML::script('TemplateAdmin/dist/js/app.js') }}
    {{ HTML::script('TemplateAdmin/plugins/jQueryUI/jquery-ui-1.10.4.custom.js') }}
    {{ HTML::script('TemplateAdmin/shortcut.js') }}
    {{ HTML::script('TemplateAdmin/plugins/numberfomater/jshashtable-3.0.js') }}
    {{ HTML::script('TemplateAdmin/plugins/numberfomater/jquery.numberformatter-1.2.4.min.js') }}
    <script>

    </script>
    @yield('footer')
  </body>
</html>