<h1>Contact Me</h1>

<?php echo validation_errors(); ?>

<?php echo form_open('welcome/contact') ?>
	<p>
	<label for="name">Name:</label>
	<?php echo form_input('name')?>
	</p>
	
	<p>
	<label for="email">Email:</label>
	<?php echo form_input('email')?>
	</p>
	
	<p>
	<label for="subject">Subject:</label>
	<?php echo form_input('subject')?>
	</p>
	
	<p>
	<label for="message">Message:</label>
	<?php echo form_textarea('message')?>
	</p>
	
	<p>
	<?php echo form_submit('submit', 'Send Message'); ?>
	</p>
<?php echo form_close(); ?>