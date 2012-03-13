<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo $title ?></title>
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
					<li class="selected">	<?php echo anchor('welcome',				'Home'		); ?></li>
					<li>					<?php echo anchor('welcome/about',			'About'		); ?></li>
					<li>					<?php echo anchor('welcome/blog',			'Blog'		); ?></li>
					<li>					<?php echo anchor('welcome/services',		'Services'	); ?></li>
					<li>					<?php echo anchor('welcome/members'	,		'Members'	); ?></li>
					<li>					<?php echo anchor('welcome/help',			'FAQs' 		); ?></li>
				</ul>
			</div>
			<div class="body">