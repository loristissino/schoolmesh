<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_attachments' => __('Attachments'),
    ),
  'current'=>$object
  ))
?>
<?php include_partial('content/attachments', array('attachments'=>$attachments, 'description'=>'Only public attachments related to this object are listed.')) ?>
