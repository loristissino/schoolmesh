<?php include_partial('content/breadcrumps', array(
  'current'=> $doc['title'],
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php if($doc['type'] == 'text/plain'): ?>
<pre>
<?php echo implode('', file($doc['file'])) ?>
</pre>
<?php endif ?>
