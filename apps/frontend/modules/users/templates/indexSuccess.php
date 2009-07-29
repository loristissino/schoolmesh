<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	__("User management")
	)
	
	?><h1><?php echo __("User management")?></h1>

<h2><?php echo __('Actions') ?></h2>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_users">
		<?php echo link_to(__('Users list'), 'users/list') ?>
	</ul>

