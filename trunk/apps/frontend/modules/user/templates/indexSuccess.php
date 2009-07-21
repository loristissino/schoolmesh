<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	__("User management")
	)
	
	?><h1><?php echo __("User management")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<pre>

<?php foreach($userlist as $myuser): ?>
	<?php echo $myuser->getFirstName() . ' ' . $myuser->getLastName() . "\n" ?>
<?php endforeach ?>
</pre>