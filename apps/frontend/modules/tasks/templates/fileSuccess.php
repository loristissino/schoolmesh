<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'tasks/index' =>__('SchoolMesh tasks')
    ),
  'current'=>__('Task execution') . ': '. $type,
  ))
?>
<pre>
<?php readfile($file) ?>
</pre>
