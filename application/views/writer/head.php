<!-- The MIT License (MIT)

Copyright (c) 2014-2017 Abdullah Almsaeed

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $records['writer_name'] ?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>favicon.ico">
<link rel="icon" type="image/ico" sizes="96x96" href="<?php echo base_url(); ?>favicon.ico">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_lte/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_lte/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_lte/dist/css/skins/_all-skins.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
.col-md-2, .col-md-10{
padding:0;
}
.panel{
margin-bottom: 0px;
}
.chat-window{
bottom:0;
position:fixed;
float:right;
margin-left:10px;
}
.chat-window > div > .panel{
border-radius: 5px 5px 0 0;
}
.icon_minim{
padding:2px 10px;
}
.msg_container_base{
background: #e5e5e5;
margin: 0;
padding: 0 10px 10px;
max-height:300px;
overflow-x:hidden;
}
.top-bar {
background: #666;
color: white;
padding: 10px;
position: relative;
overflow: hidden;
}
.msg_receive{
padding-left:0;
margin-left:0;
}
.msg_sent{
padding-bottom:20px !important;
margin-right:0;
}
.messages {
background: white;
padding: 10px;
border-radius: 2px;
box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
max-width:100%;
}
.messages > p {
font-size: 13px;
margin: 0 0 0.2rem 0;
}
.messages > time {
font-size: 11px;
color: #ccc;
}
.msg_container {
padding: 10px;
overflow: hidden;
display: flex;
}
img {
display: block;
width: 100%;
}
.avatar {
position: relative;
}
.base_receive > .avatar:after {
content: "";
position: absolute;
top: 0;
right: 0;
width: 0;
height: 0;
border: 5px solid #FFF;
border-left-color: rgba(0, 0, 0, 0);
border-bottom-color: rgba(0, 0, 0, 0);
}
.base_sent {
justify-content: flex-end;
align-items: flex-end;
}
.base_sent > .avatar:after {
content: "";
position: absolute;
bottom: 0;
left: 0;
width: 0;
height: 0;
border: 5px solid white;
border-right-color: transparent;
border-top-color: transparent;
box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}
.msg_sent > time{
float: right;
}
.msg_container_base::-webkit-scrollbar-track
{
-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
background-color: #F5F5F5;
}
.msg_container_base::-webkit-scrollbar
{
width: 12px;
background-color: #F5F5F5;
}
.msg_container_base::-webkit-scrollbar-thumb
{
-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
background-color: #555;
}
.btn-group.dropup{
position:fixed;
left:0px;
bottom:0;
}
</style>
</head>