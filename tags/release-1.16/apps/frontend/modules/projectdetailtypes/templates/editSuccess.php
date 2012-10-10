<?php use_helper('I18N', 'Date') ?>
<?php include_partial('projectdetailtypes/assets') ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects management"),
    'projectdetailtypes/index' =>__("Project detail type list")
    ),
  'current'=>__('Edit'),
  ))
?>

<?php use_helper('I18N', 'Date') ?>
<?php include_partial('projectdetailtypes/assets') ?>

  <?php include_partial('projectdetailtypes/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('projectdetailtypes/form_header', array('ProjDetailType' => $ProjDetailType, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('projectdetailtypes/form', array('ProjDetailType' => $ProjDetailType, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('projectdetailtypes/form_footer', array('ProjDetailType' => $ProjDetailType, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
