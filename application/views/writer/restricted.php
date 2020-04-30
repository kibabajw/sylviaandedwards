<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Restricted</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="container">
<div style="margin-top: 60px;margin-left: auto;margin-right: auto;text-align: center;">
	<h1>You are not logged in!</h1>
	<p><?= anchor('writer/Auth_Writer_Controller/load_login_form', 'Click here to log-in') ?></p>
</div>
</body>
</html>