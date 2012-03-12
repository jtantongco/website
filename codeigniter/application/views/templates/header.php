<html>
<head>
	<title><?php echo $title ?> </title>
</head>
<body>

	<table>
		<tr>
			<td>
				<img src='<?php echo logo ?>'>
			</td>
			<td>
				<table>
					<tr>
						<td><?php echo anchor('sessions/sign_up'		,'Sign up'	); ?></td>
						<td><?php echo anchor('sessions/log_in'			,'Log In'	); ?></td>
					</tr>
					<tr>
						<td><?php echo anchor('welcome'					,'Home'		); ?></td>
						<td><?php echo anchor('welcome/help'			,'FAQs' 	); ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</br>
</br>