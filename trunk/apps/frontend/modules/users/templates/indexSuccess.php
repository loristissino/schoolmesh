<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	__("User management")
	)
	
	?><h1><?php echo __("User management")?></h1>

<h2><?php echo __('Actions') ?></h2>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_users">
		<?php echo link_to(__('User list'), 'users/list') ?>
	</li><br />
	<li class="sf_admin_action_userchecks">
		<?php echo link_to(__('Run user checks'), 'users/runuserchecks') ?>
	</li><br />
	<li class="sf_admin_action_googleapps">
		<?php echo link_to(__('Upload Google Apps data'), 'users/uploadgoogleappsdata') ?>
	</li><br />
	</ul>

