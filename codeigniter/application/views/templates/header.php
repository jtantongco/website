<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Xayona Website Template</title>
		<link rel="stylesheet" href="<?php echo template ?>" type="text/css" />
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7.css" type="text/css" />
		<![endif]-->
	</head>
	<body>
		<div class="page">
			<div class="header">
				<a href="index.html" id="logo"><img src="<?php echo logo ?>" alt=""/></a>
				<ul>
					<li class="selected"><a href="index.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="blog.html">Blog</a></li>
					<li><a href="services.html">Services</a></li>
					<li><?php echo anchor('sessions/sign_up'		,'Sign up'	); ?></li>
					<li><?php echo anchor('sessions/log_in'			,'Log In'	); ?></li>
					<li><?php echo anchor('welcome'					,'Home'		); ?></li>
					<li><?php echo anchor('welcome/help'			,'FAQs' 	); ?></li>
				
				</ul>
			</div>
			<div class="body">