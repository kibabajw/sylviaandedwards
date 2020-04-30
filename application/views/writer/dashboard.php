<?php $this->load->view('writer/head') ?>
<body class="hold-transition skin-blue">
<!-- 	header -->
  <header class="main-header">
      <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Write Bright</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>.::Writer's Panel::.</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>profile_pictures/<?= $records['member_picture'] ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $records['writer_name'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>profile_pictures/<?= $records['member_picture'] ?>" class="user-image" alt="User Image">
                <p>
                  <?= $records['writer_name'] ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                	<div class="btn btn-default btn-flat"><?= anchor('writer/Writer_Dashboard_Controller/logout', 'logout') ?></div>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<div class="row top_info_div" style="margin: 10px 0 0 10px;width:100%;text-align:center;">
  <h4 id="time_remaining_div" class="text-danger">Time remaining</h4>
</div>
<!-- main content -->
  <!-- Content Wrapper. Contains page content -->
  <div style="margin-top:20px;" class="container">
    <section class="">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img src="<?php echo base_url(); ?>profile_pictures/<?= $records['member_picture'] ?>" class="profile-user-img img-responsive img-circle" alt="User Avatar" style="width: 150px;height:150px;">

              <h3 class="profile-username text-center"><?= $records['writer_name'] ?></h3>

              <p class="text-primary text-center">Write Bright researcher</p>

              <ul class="list-group list-group-unbordered">
              	<li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?= $records['writer_email'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right"><?= $records['writer_phone_number'] ?></a>
                </li>
                 <li class="list-group-item">
                  <b>Writer position</b> <a class="pull-right"><?= $records['writer_position'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Writer level</b> <a class="pull-right"><?= $records['writer_level'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>My Orders</b> <a class="pull-right"><?= $records['my_orders'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Total pages</b> <a class="pull-right"><?= $records['my_pages'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Total price</b> <a class="pull-right"><?= $records['my_tot_price'] ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                <?= $records['writer_academic_info'] ?>
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i>Addres</strong>
              <p class="text-muted">
              	<?= $records['writer_address'] ?>
              </p>
              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#memo" data-toggle="tab">Memo</a></li>
              <li><a href="#myorders" data-toggle="tab">My Orders</a></li>
              <li><a href="#notifications" data-toggle="tab">Notifications</a></li>
              <li><a href="#workspace" data-toggle="tab">Workspace</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
              <li><a href="#submit_order" data-toggle="tab">Submit order</a></li>
              <li><a href="#profile_picture_tab" data-toggle="tab">Profile picture</a></li>
              <li><a href="#chat_tab" data-toggle="tab">Chat</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="memo">
                 <div id="memo_body"></div>
              </div>
              <div class="tab-pane" id="myorders">
              	<!-- data-table with my orders shall apear here        	              	 -->
              </div>
               <!-- /.tab-pane -->
               <div class="tab-pane" id="notifications">
                <!-- notifications data goes here -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="workspace">
                <!-- The workspace -->
                <ul class="timeline timeline-inverse">
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <div style="margin-left:60px;" id="workspace-body">
                        <!--notification content will go here -->
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="settings">
        			<?php $this->load->view('writer/settings') ?>
              </div>
              <div class="tab-pane" id="submit_order">
              	<h3>Submit order</h3>
              	<span id="order_submit_error" style="color:#FF0000;font-size:16px;"></span>
              	 <?= form_open_multipart('writer/Writer_Dashboard_Controller/submit_order', 'id="form_submit_order"') ?> 
              			<div id="order_ids_dropdown"></div>
                    <!-- start multiple files upload -->
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-sm-8">
                        <div id="container">
                        <div id="body">
                          <div class="row" style="margin:0px;padding:15px 0px;font-size:18px;background-color:#e3e3e3;text-align:center;">                            
                                <h4>Click on ADD file button to add more files</h4>                            
                          </div>      
                        <div class="row" style="margin:0px;padding:20px 0px;text-align:center;">
                          <div class="col-xs-12 col-sm-12 col-md12 col-lg-12">
                              <button id="addfile" class="btn btn-danger">Add file</button>
                          </div>
                        </div>      
                        <div class="row" style="margin:0px;padding:20px 0px;text-align:center;">
                        <div class="col-xs-12 col-sm-12 col-md12 col-lg-12">
                            <div id="uploadFileContainer"></div>
                        </div>
                        </div>
                      </div>
                      </div>
                      </div>  
                    </div>
                    <!-- end files upload -->
                    <p>Have you adhered to the check list requirements ? <?= anchor('https://drive.google.com/open?id=1zgZOiGXCd-SYg2mkytZ99k4fsvE-zPck', 'Link to the checklist', 'target="blank"') ?></p>
                    <input type="checkbox" name="yes" value="Yes" required>&nbsp;Yes i have.<br>
              		<button type="submit" name="btn_order_submit" id="btn_order_submit" class="btn btn-primary" style="margin-top:30px;">Submit order</button>
              	<?= form_close() ?>
              </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="profile_picture_tab">
        			    <?php $this->load->view('writer/profile-picture') ?>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="chat_tab">
        			    <?php $this->load->view('writer/chat') ?>
                </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  <aside class="side_div_for_files" style="display:none;width:35%;padding:10px;margin-top:69px;background:#eee;height:auto;position:absolute;right:0;top:0;">
      <div><h2 id="btn_close_side_div" style="cursor:pointer;">&times;</h2></div>
      <h4>Click on a file to download</h4>
    <div id="file_holder"></div>
  </aside>
<!-- /.main content ends -->  
<?php $this->load->view('writer/footer') ?>
<script>
	//loads memo
	$(document).ready(function() {
	  //populate data to tabs
	  $("#myorders").load('<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/get_my_orders');
    
    // fetch ids for orders to be submitted and re-submitted
    $("#order_ids_dropdown").load('<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/order_ids_to_submit');
    

    var chat = {}
    chat.my_workspace = function(){
      //populate tab with workspace data
      $("#workspace-body").load('<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/workspace_data');
    }
    chat.admin_notify = function(){
      //populate tab with workspace data
      $("#notifications").load('<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/notifications');
    }
    chat.show_memo = function(){
      var memo_url = '<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/my_memo';
        $.get(memo_url, function(response){
          $("#memo_body").html(response);
        });
    }
  chat.time_remaining = function(data){
    var url = "<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/calculate_time_remaining";	
    $.get(url, function(response){
      $("#time_remaining_div").html(response);
    });
  }
	chat.interval = setInterval(chat.my_workspace, 2000);
	chat.my_workspace();
  chat.interval = setInterval(chat.show_memo, 2000);
	chat.show_memo();  
  chat.interval = setInterval(chat.admin_notify, 2000);
	chat.admin_notify();  
  // chat.interval = setInterval(chat.order_ids_to_submit, 2000);
	// chat.order_ids_to_submit(); 
  chat.interval = setInterval(chat.time_remaining, 1000);
	chat.time_remaining(); 

	});
	//toggle order instructions
	function order_instructions(data){
		$(data).toggle();
	}
	//jquery function to download files
	function download_files(fileId){
		var dataString = 'fileId='+fileId;      
	  	$.ajax({
			type:"POST",
			url: "<?php echo base_url() ?>index.php/writer/Writer_Dashboard_Controller/download_order_files",
			data:dataString,
			cache:false,
			success:function(html){
				alert(html);
				//$("#center").html(html);
			}
		});
		return false;	
	}

	function accept_order(orderId){
		//$("#btn_accept_order").hide();
		var dataString = 'orderId='+orderId;      
	  	$.ajax({
			type:"POST",
			url: "<?php echo base_url() ?>index.php/writer/Writer_Dashboard_Controller/writer_accept_order",
			data:dataString,
			cache:false,
			success:function(html){
			//$("#center").html(html);
				alert(html);
			}
		});
		return false;
	}
	//function to submit order
	 $("#form_submit_order").submit(function(e){        
                event.preventDefault();
                $.ajax({
                url: '<?php echo base_url() ?>index.php/writer/Writer_Dashboard_Controller/submit_order', 
                type: 'POST',
                data: new FormData($('#form_submit_order')[0]), // The form with the file inputs.
                processData: false,
                contentType: false                    // Using FormData, no need to process data.
           }).done(function(html){
           	 	$("form").trigger("reset");
             	$('#order_submit_error').html(html);
           }).fail(function(html){
             $("#order_submit_error").html("An error occured");
           });      
        });

 //update writer's details
  $("#btn_update_writer_details").click(function(e){
      e.preventDefault();
      $.ajax({
            url:'<?php echo base_url() ?>index.php/writer/Writer_Dashboard_Controller/update',
            method: 'post',
            data: new FormData($('#form-update-writer-details')[0]), // The form with the file inputs.
            processData: false,
            contentType: false 
        }).done(function(response){
            $("#update_writer_msg").text(response);
        }).fail(function(response){
            $("#update_writer_msg").html("An error occured, please try again.");
        }); 
  });        
// fetch order files on link click
  function set_id(id_set){
      $(".side_div_for_files").show();
      var dataString = 'id_set='+id_set;      
	  	$.ajax({
			type:"POST",
			url: "<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/get_files",
			data:dataString,
			cache:false,
			success:function(html){
				// $("#" + id_set).html(html);
        $("#file_holder").html(html);
			}
		});
		return false;	
  }
  $("#btn_close_side_div").click(function(){
    $(".side_div_for_files").toggle();
  });

  // hide notification
  function hide_notification(not_id){
    var dataString = 'not_id='+not_id;      
	  	$.ajax({
			type:"POST",
			url: "<?php echo base_url(); ?>index.php/writer/Writer_Dashboard_Controller/hide_notification",
			data:dataString,
			cache:false,
			success:function(response){
        alert(response);
			}
		});
		return false;	
  }
  // start logic for multiple files
  $("#addfile").click(function(){
          event.preventDefault();
          addFileInput();
  });
  function addFileInput(){
      var html = '';
      html += '<div class="alert alert-info">';
      html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      html += '<strong>Upload file</strong>';
      html += '<input type="file" name="multipleFiles[]" id="userfile">';
      html += '</div>';

      $("#uploadFileContainer").append(html);
  }

</script>


