<?php use_helper('I18N', 'Date') ?>
<?php include_partial('projectcategories/assets') ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__('Projects management'),
    'projectcategories/index'=>__('Project category list'),

    ),
  'current'=>__('Edit project category'),
  ))
?>

  <?php include_partial('projectcategories/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('projectcategories/form_header', array('ProjCategory' => $ProjCategory, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('projectcategories/form', array('ProjCategory' => $ProjCategory, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('projectcategories/form_footer', array('ProjCategory' => $ProjCategory, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
