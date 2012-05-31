<h1 class="topbar"><?php echo sfConfig::get('app_school_name'); ?></h1>

<h2><?php echo __('You must accept the license in order to use this application.') ?></h2>

<p>
<?php echo link_to(
  __('License'),
  url_for('content/license')
  )
?></p>

<p><?php echo __('Please refer to the wiki pages of SchoolMesh and edit the app.yml file.') ?></p>
