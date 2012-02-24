<h2>Log in to the system</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('sessions/log_in') ?>

	<p>
	<label for="user_name">User Name: </label> 
	<?php echo form_input('user_name'); ?>
	</p>
	
	<p>
	<label for="pswd">Password: </label> 
	<?php echo form_password('password'); ?>
	</p>
	
	<p>
	<?php echo form_submit('submit', 'Log In'); ?>
	</p>
	
<?php echo form_close(); ?>

</br>
</br>