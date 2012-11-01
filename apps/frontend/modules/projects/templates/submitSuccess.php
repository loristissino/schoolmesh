<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => "Projects",
    'projects/edit?id=' . $project->getId() => $project->getTitle(),
    ),
  'current'=>__('Document submission'),
  ))
?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php if(isset($checkList)): ?>
	<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>false)) ?>
<?php endif ?>

