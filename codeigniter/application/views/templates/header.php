<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Xayona Website Template</title>
		<link rel="stylesheet" href="<?php echo template ?>"			type="text/css" />
		<link rel="stylesheet" href="<?php echo display_elements ?>" 	type="text/css" />
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7.css" type="text/css" />
		<![endif]-->
	</head>
	<body>
		<div class="page">
			<div class="header">
				<a href="index.html" id="logo"><img src="<?php echo logo ?>" alt=""/></a>
				<ul>
					<!-- Can have <li class="selected"> but that is pain since has to be done on each individual page -->
					<li><?php echo anchor('welcome',				'Home'		); ?></li>
					<li><?php echo anchor('welcome/about',			'About'		); ?></li>
					<li><?php echo anchor('welcome/blog',			'Blog'		); ?></li>
					<li><?php echo anchor('welcome/services',		'Services'	); ?></li>
					<li><?php echo anchor('welcome/members'	,		'Members'	); ?></li>
					<li><?php echo anchor('welcome/contact',		'Contact' 	); ?></li>
				</ul>
			</div>
			<div class="body">
				<?php if(!empty($check)): ?>
					<div id='check'>
						<?php echo $check ?>
					</div>
				<?php endif; ?>
		
				<?php if(!empty($cross)): ?>
					<div id='cross'>
						<?php echo $cross ?>
					</div>
				<?php endif; ?>
		
				<?php if(!empty($notice)): ?>
					<div id='notice'>
						<?php echo $notice ?>
					</div>
				<?php endif; ?>