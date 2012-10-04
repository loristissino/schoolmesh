<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'tasks/index' =>__('SchoolMesh Tasks')
    ),
  'current'=>__('Task execution'),
  ))
?>
<pre>
<?php readfile($file) ?>
</pre>
