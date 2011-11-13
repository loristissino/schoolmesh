<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'content/index' =>__("Home")
    ),
  'current'=>__('Setup checks'),
  ))
?>

<p><?php echo __('Setup checks are currently not enabled.') ?> 
<?php echo __('You can enable them by setting app_config_enable_checks to true in your apps/frontend/config/app.yml file.') ?>
</p>