<h2>Register as a new general user!<h2>

<?php echo validation_errors(); ?>

<?php echo form_open('sessions/sign_up') ?>
	
	<p>
	<label for="user_name">User Name:</label>
	<?php echo form_input('user_name') ?>
	</p>
	
	<p>
	<label for="password">Password:</label>
	<?php echo form_password('password') ?>
	</p>
	
	<p>
	<label for="password_conf">Password Confirmation:</label>
	<?php echo form_password('password_conf') ?>
	</p>
	
	<p>
	<label for="email">Email:</label>
	<?php echo form_input('email') ?>
	</p>
	
	<p>
	<label for="first_name">First Name:</label>
	<?php echo form_input('first_name') ?>
	</p>
	
	<p>
	<label for="last_name">Last Name:</label>
	<?php echo form_input('last_name') ?>
	</p>
	
	<p>
	<label for="home_phone">Home Phone:</label>
	<?php echo form_input('home_phone') ?>
	</p>
	
	<p>
	<label for="cell_phone">Mobile Phone:</label>
	<?php echo form_input('cell_phone') ?>
	</p>
	
	<p>
	<label for="gender">Gender:</label>
	<?php 
		$options = array('' => 'Select Gender', 'male' => 'male', 'female' => 'female');
		echo form_dropdown('gender', $options, ''); 
	?>
	</p>	
				
	<h3>Need to implement a date picker for this Field</h3>
	<p>
	<label for="birthday">Birthday:</label>
	<?php echo form_input('birthday') ?>
	</p>
	
	<p>
	<label for="address">Address:</label>
	<?php echo form_input('address') ?>
	</p>
	
	<p>
	<label for="city">City:</label>
	<?php echo form_input('city') ?>
	</p>
	
	<h3>This needs a country drop down</h3>
	<p>
	<label for="country">Country:</label>
	<?php echo form_input('country') ?>
	</p>
	
	<h3>This needs a javascript dropdown that is tied to the country dropdown</h3>
	<p>
	<label for="province_state">Province/State:</label>
	<?php echo form_input('province_state') ?>
	</p>
	
	<p>
	<label for="postal_code">Postal Code:</label>
	<?php echo form_input('postal_code') ?>
	</p>
	
	<p>
	<label for="profile_picture">Profile Picture:</label>
	<?php echo form_input('profile_picture') ?>
	</p>
	
	<!--
	<?php // echo form_hidden('aid', 1); ?>
	<?php // echo form_hidden('accConf', 0); ?>
	-->
	
	<p>
	<?php echo form_submit('submit', 'Register'); ?>
	</p>
<?php echo form_close(); ?>