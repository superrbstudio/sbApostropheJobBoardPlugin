<form action="<?php echo url_for('@sb_job_board_application'); ?>" method="post" id="candidates-application-form" enctype="multipart/form-data">
	<?php echo $form['_csrf_token']->render(); ?>

	<?php if($showThanks == true): ?>
	<h2>Thank you for your CV</h2>
	<p>We will be in contact shortly with any opportunities.</p>
	<?php else: ?>
	<h2>Personal Details</h2>
	<?php if($form->hasErrors()): ?>
	<p class="error-message">Please check the fields marked in red below and try again.</p>
	<?php endif; ?>
	<p<?php if($form['name']->hasError()): ?> class="error"<?php endif; ?>><?php echo $form['name']->render(); ?></p>
	<p<?php if($form['email']->hasError()): ?> class="error"<?php endif; ?>><?php echo $form['email']->render(); ?></p>
	<p<?php if($form['phone_number']->hasError()): ?> class="error"<?php endif; ?>><?php echo $form['phone_number']->render(); ?></p>
	<p<?php if($form['job_type']->hasError()): ?> class="error"<?php endif; ?>><?php echo $form['job_type']->render(); ?></p>
	<?php if($form['cv_file']->hasError()): ?>
	<p class="error-message"><?php echo $form['cv_file']->renderError(); ?></p>
	<?php endif; ?>
	<p<?php if($form['cv_file']->hasError()): ?> class="error"<?php endif; ?>><?php echo $form['cv_file']->renderLabel(); ?><?php echo $form['cv_file']->render(); ?></p>
	<p class="submit"><input type="image" src="/images/structure/submit-cv-button-text.png" alt="Submit" /></p>
	<?php endif; ?>

</form>
