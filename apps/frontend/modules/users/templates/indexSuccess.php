<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	__("User management")
	)
	
	?><h1><?php echo __("User management")?></h1>

<h2><?php echo __('Actions') ?></h2>

<h3><?php echo __('Basic users information') ?></h3>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_users">
		<?php echo link_to(__('User list'), 'users/list') ?>
	</li><br />
	<li class="sf_admin_action_new">
		<?php echo link_to(__('Add a new user'), 'users/new', array('title'=>__(SentencePeer::getSentence('users_new'))))?>
	</li><br />
	</ul>

<h3><?php echo __('System administration') ?></h3>

	<ul class="sf_admin_actions">
		<li class="sf_admin_action_upload">
		<?php echo link_to(__('Upload classes'), url_for('users/upload?what=classes'), array('title'=>__(SentencePeer::getSentence('users_bulk_upload_classes'))))?>
	</li><br />
	<li class="sf_admin_action_upload">
		<?php echo link_to(__('Upload users'), url_for('users/upload?what=users'), array('title'=>__(SentencePeer::getSentence('users_bulk_upload_users'))))?>
	</li><br />
	<li class="sf_admin_action_upload">
		<?php echo link_to(__('Upload appointments'), url_for('users/upload?what=appointments'), array('title'=>__(SentencePeer::getSentence('users_bulk_upload_appointments'))))?>
	</li><br />
	<li class="sf_admin_action_userchecks">
		<?php echo link_to(__('Run team checks'), 'users/runteamchecks', array('title'=>__(SentencePeer::getSentence('run_team_checks')))) ?>
	</li><br />
	</ul>

<p><?php echo image_tag('star') ?> <?php echo __('Years, Roles, Subjects, Reserved usernames, and Tracks can be managed only in the backend application.') ?></p>

