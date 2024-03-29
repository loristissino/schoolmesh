<?php use_helper('I18N', 'Date') ?>
<?php include_partial('projectdetailtypes/assets') ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects management")
    ),
  'current'=>__('Project detail type list'),
  ))
?>

  <?php include_partial('projectdetailtypes/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('projectdetailtypes/list_header', array('pager' => $pager)) ?>
  </div>
  
  <div id="sf_admin_content">
    <form action="<?php echo url_for('proj_detail_type_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('projectdetailtypes/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('projectdetailtypes/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('projectdetailtypes/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('projectdetailtypes/list_footer', array('pager' => $pager)) ?>
  </div>

  <hr />
  
  <div>
    <?php include_partial('projectdetailtypes/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>
