<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_users' => __("User's settings"),
    '_filebrowser'=>__("File browser"),
    ),
  'current'=>__('Directory creation'),
  ))
?>

<?php include_partial('makedir', array('form'=>$form)) ?>
