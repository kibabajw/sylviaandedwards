<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>404-page</title>
<style type="text/css">
body {
background: #eee;
}
.container{
padding:5%;
}
.lead{
background:#fff;
padding:4%;
}
</style>
</head>
<body>
<div class="page-wrap d-flex flex-row align-items-center">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-12 text-center">
<span class="display-1 d-block">404</span>
<div class="mb-4 lead">
<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
</div>
</div>
</div>
</div>
</div>
</body>
</html>