<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
<!-- Logo -->
<a href="" class="logo">
<!-- mini logo for sidebar mini 50x50 pixels -->
<span class="logo-mini"><b>S&E</b></span>
<!-- logo for regular state and mobile devices -->
<span class="logo-lg"><b>S&E</b>&nbsp;PANEL</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
<span class="sr-only">Toggle navigation</span>
</a>
<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo base_url(); ?>profile_pictures/admin/<?= $records['admin_picture'] ?>" class="user-image" alt="User Image">
<span class="hidden-xs"><?= $records['admin_name'] ?></span>
</a>
<ul class="dropdown-menu">
<!-- User image -->
<li class="user-header">
<img src="<?php echo base_url(); ?>profile_pictures/admin/<?= $records['admin_picture'] ?>" class="img-circle" alt="User Image">
<p><?= $records['admin_name'] ?> - <?= $records['privilege_name'] ?></p>
</li>
<!-- Menu Footer-->
<li class="user-footer">
<div class="pull-right">
<div class="btn btn-default btn-flat"><?= anchor('admin/Dashboard_controller/logout', 'logout'); ?></div>
</div>
</li>
</ul>
</li>
<!-- Control Sidebar Toggle Button -->
<li>
<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
</ul>
</div>

</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
<!-- Sidebar user panel -->
<div class="user-panel">
<div class="pull-left image">
<img src="<?php echo base_url(); ?>profile_pictures/admin/<?= $records['admin_picture'] ?>" class="img-circle" alt="User Image">
</div>
<div class="pull-left info">
<p><?= $records['admin_name'] ?></p>
<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
</div>
</div>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
<li class="header">MAIN NAVIGATION</li>
<li class="active treeview menu-open">
<a>
<i class="fa fa-dashboard"></i><span>Dashboard Actions</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="main_data()" style="cursor: pointer;">
<i class="fa fa-home" aria-hidden="true"></i> <span>Home</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="load_page()" style="cursor: pointer;">
<i class="fa fa-pencil" aria-hidden="true"></i> <span>New order</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="load_new_draft()" style="cursor: pointer;">
<i class="fa fa-floppy-o" aria-hidden="true"></i><span>New Draft</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="load_draft_orders()" style="cursor: pointer;">
<i class="fa fa-file-archive-o" aria-hidden="true"></i><span>Drafts</span>
</a>
</li>
<li>
<a id="link_activity" onclick="load_new_revision()" style="cursor: pointer;">
<i class="fa fa-recycle" aria-hidden="true"></i><span>New Revision</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="recall_order()" style="cursor: pointer;">
<i class="fa fa-briefcase" aria-hidden="true"></i> <span>Workspace</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="completed_order_files()" style="cursor: pointer;">
<i class="fa fa-folder-o" aria-hidden="true"></i> <span>Completed Files</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="trash_orders()" style="cursor: pointer;">
<i class="fa fa-trash-o" aria-hidden="true"></i><span>Trash</span>
</a>
</li>
<li>        
<a id="link_new_task" onclick="load_rates()" style="cursor: pointer;">
<i class="fa fa-steam" aria-hidden="true"></i> <span>Rates</span>
</a>
</li>
<li>
<a id="link_members" onclick="load_members()" style="cursor: pointer;">
<i class="fa fa-users"></i>
<span>Members</span>
</a>
</li>
<li>
<a id="link_members" onclick="load_applications()" style="cursor: pointer;">
<i class="fa fa-folder-open-o" aria-hidden="true"></i>
<span>Applications</span>
</a>
</li>
<li>
<a id="link_memo" onclick="load_memo()" style="cursor: pointer;">
<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
<span>Memo</span>
</a>
</li>
<li>
<a id="link_activity" onclick="load_posted_orders()" style="cursor: pointer;">
<i class="fa fa-clock-o" aria-hidden="true"></i><span>Posted orders</span>
</a>
</li>
<li>
<a id="link_activity" onclick="load_started_orders()" style="cursor: pointer;">
<i class="fa fa-hourglass-start" aria-hidden="true"></i><span>Orders started</span>
</a>
</li>
<li>
<a id="link_activity" onclick="load_completed_orders()" style="cursor: pointer;">
<i class="fa fa-trophy" aria-hidden="true"></i><span>Completed orders</span>
</a>
</li>
<li>
<a id="link_activity" onclick="load_revision_orders()" style="cursor: pointer;">
<i class="fa fa-recycle" aria-hidden="true"></i><span>Revisions</span>
</a>
</li>
<li>
<a id="link_activity" onclick="load_approved_orders()" style="cursor: pointer;">
<i class="fa fa-money" aria-hidden="true"></i><span>Approved orders</span>
</a>
</li>
<li>
<a id="link_chat" onclick="load_chat()" style="cursor: pointer;">
<i class="fa fa-comment" aria-hidden="true"></i><span>Chat</span>
</a>
</li>
<li>
<a id="link_chat" onclick="load_stats()" style="cursor: pointer;">
<i class="fa fa-pie-chart" aria-hidden="true"></i><span>Stats</span>
</a>
</li>
<li>
<a id="link_chat" onclick="load_messages()" style="cursor: pointer;">
<i class="fa fa-envelope" aria-hidden="true"></i><span>Messages</span>
</a>
</li>
<li>
<a id="link_chat" onclick="load_profile()" style="cursor: pointer;">
<i class="fa fa-user" aria-hidden="true"></i><span>Profile</span>
</a>
</li>
<li>
<a id="link_chat" onclick="load_assist()" style="cursor: pointer;">
<i class="fa fa-wrench" aria-hidden="true"></i><span>Assist</span>
</a>
</li>
<li>
<a id="link_activity" onclick="load_finances()" style="cursor: pointer;">
<i class="fa fa-money" aria-hidden="true"></i><span>Finances</span>
</a>
</li>
</ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
<span><?= $time_now ?></span>
</h1>
<ol class="breadcrumb">
<li><a onclick="main_data()" style="cursor: pointer;"><i class="fa fa-dashboard"></i>Home</a></li>
<li class="active">Dashboard</li>
</ol>
</section>
<div class="" id="main_content" style="margin-left: 20px;margin-right:15px;">
<!-- 	main page content goes here -->		

<!-- main page content ends here -->
</div>
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">
<b></b>
</div>
<strong></strong>.
</footer>
<!-- Control Sidebar -->
<?php $this->load->view('admin/fragments/sidebar-controller') ?>
<!-- /.control-sidebar -->  
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>admin_lte/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
//call the function to load main_cont data
main_data();
//fetches with interval the main_content data
var chat = {}
chat.load_calendar = function(){
  var cal_url = '<?php echo base_url(); ?>index.php/admin/dashboard_controller/admin_calendar';
  $.get(cal_url, function(response){
  $(".calendar_container").html(response);
  });
}
chat.load_writers = function(){
  $.get('<?php echo base_url(); ?>index.php/admin/dashboard_controller/writers_dist', function(response){
  $(".ext-data").html(response);
  });
}
chat.load_orders_dist = function(){
  $.get('<?php echo base_url(); ?>index.php/admin/dashboard_controller/orders_distribution', function(response){
  $("#orders_dist").html(response);
  });
}
chat.activity_notify = function(data){
  var url = "<?php echo base_url(); ?>index.php/admin/dashboard_controller/data";	
  $.get(url, function(data){
  var html = "";
  $.each(JSON.parse(data),function(key,value){
  html += '<section class="content">';
  html += '<!-- Info boxes -->';
  html += '<div class="row">';
  html += '<div class="col-md-3 col-sm-6 col-xs-12">';
  html += '<div class="info-box">';
  html += '<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>';
  html += '<div class="info-box-content">';
  html += '<span class="info-box-text">ONLINE</span>';
  html += '<span class="info-box-number">'+value.online_count+'</span>';
  html += '</div>';
  html += '<!-- /.info-box-content -->';
  html += '</div>';
  html += '<!-- /.info-box -->';
  html += '</div>';
  html += '<!-- /.col -->';
  html += '<div class="col-md-3 col-sm-6 col-xs-12">';
  html += '<div class="info-box">';
  html += '<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>';
  html += '<div class="info-box-content">';
  html += '<span class="info-box-text">VISITORS COUNTER</span>';
  html += '<span class="info-box-number">0</span>';
  html += '</div>';
  html += '<!-- /.info-box-content -->';
  html += '</div>';
  html += '<!-- /.info-box -->';
  html += '</div>';
  html += '<!-- /.col -->';
  html += '<!-- fix for small devices only -->';
  html += '<div class="clearfix visible-sm-block"></div>';
  html += '<div class="col-md-3 col-sm-6 col-xs-12">';
  html += '<div class="info-box">';
  html += '<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>';
  html += '<div class="info-box-content">';
  html += '<span class="info-box-text">APPROVED ORDERS</span>';
  html += '<span class="info-box-number">'+value.completed_orders+'</span>';
  html += '</div>';
  html += '<!-- /.info-box-content -->';
  html += '</div>';
  html += '<!-- /.info-box -->';
  html += '</div>';
  html += '<!-- /.col -->';
  html += '<div class="col-md-3 col-sm-6 col-xs-12">';
  html += '<div class="info-box">';
  html += '<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>';
  html += '<div class="info-box-content">';
  html += '<span class="info-box-text">Applicants</span>';
  html += '<span class="info-box-number">'+value.applications+'</span>';
  html += '</div>';
  html += '</div>';
  html += '</div>';
  html += '</div>';
  html += '</section>';
  });

$("#data").html(html);
  });
}

chat.dashboard_notify = function(data){
  var url = "<?php echo base_url(); ?>index.php/admin/dashboard_controller/notify_admin";	
  $.get(url, function(response){
    $(".notific_container").html(response);
  });
}

chat.interval = setInterval(chat.activity_notify, 2000);
chat.activity_notify();
chat.interval = setInterval(chat.load_calendar, 2000);
chat.load_calendar();
chat.interval = setInterval(chat.load_writers, 2000);
chat.load_writers();
chat.interval = setInterval(chat.load_orders_dist, 2000);
chat.load_orders_dist();
chat.interval = setInterval(chat.dashboard_notify, 2000);
chat.dashboard_notify();

});
//loads the main_content data
function main_data(){
  var data_url = '<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_main_content';
  $.get(data_url, function(response){
    $("#main_content").html(response);
  });
}	

//fetch admin's notifications
var chat = {}
chat.activity_notify = function(){
  var data_url = '<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_main_content';
  // $("#main_content").load(data_url);	
  $.get(data_url, function(response){
    $("#main_content").html(response);
  });
}
// chat.interval = setInterval(chat.activity_notify, 2000);
// chat.activity_notify();

//onclick functions
function load_page(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_page');	
}
function load_new_draft(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_new_draft');	
}
function load_draft_orders(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/draft_orders');	
}
function load_new_revision(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/new_revision');	
}
function recall_order(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/recall_order_view');	
}
function completed_order_files(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/get_completed_files');	
}
function trash_orders(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/trash_orders_view');	
}
function load_rates(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_price_rates');	
}
function load_members(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_members');
}
function load_applications(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_applications');
}
function load_memo(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_memo');
}
function load_posted_orders(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/orders_posted');
}
function load_started_orders(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/orders_started');
}
function load_completed_orders(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/orders_completed');
}
function load_revision_orders(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/orders_revision');
}
function load_approved_orders(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/orders_approved');
}
function load_chat(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_chat');
}
function load_stats(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_stats');
}
function load_messages(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_messages');
}
function load_profile(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_profile');
}
function load_assist(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_assist');
}
function load_finances(){
  $("#main_content").load('<?php echo base_url(); ?>index.php/admin/dashboard_controller/load_finances');
}
//deleting a notification
function del_notification(notificationId){
  var dataString = 'notificationId='+notificationId;
  $.ajax({
    type:"POST",
    url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/delete_notification",
    data:dataString,
    cache:false,
  success:function(html){
    alert(html);
  }
  });
}

</script>

