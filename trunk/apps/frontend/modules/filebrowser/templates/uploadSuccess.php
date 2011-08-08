<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_users' => __("User's settings"),
    '_filebrowser'=>__("File browser"),
    ),
  'current'=>__('File upload'),
  ))
?>

<?php include_partial('fileupload', array('form'=>$form)) ?>
