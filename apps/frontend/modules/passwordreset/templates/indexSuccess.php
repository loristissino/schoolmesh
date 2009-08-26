<?php slot('title', __('Password reset')) ?>
<?php slot('breadcrumbs',
	__("Password reset")
	)
	
	?><h1><?php echo __("Password reset")?></h1>
	
<p><?php echo __('This page is for resetting the password of the students that migth have forgot it.') ?></p>
<p><?php echo __('Teachers\'s and staff\'s passwords can be reset only by an administrator.') ?></p>

<pre>
<?php foreach($userlist as $user): ?>
	<?php echo $user->getsfGuardUser()->getProfile()->getFullname() . "\n" ?>
<?php endforeach ?>
</pre>
