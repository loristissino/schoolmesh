<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/list' =>__("Users"),
    'users/edit?id='.$current_user->getUserId() => $current_user->getFullName()
    ),
  'current'=>__('Add to team(s)'),
  'title'=>__('Add %user% to team(s)', array('%user%'=>$current_user->getFullName()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('users/addtoteam?user='. $current_user->getUserId()) ?>" method="post">

<p>
<?php foreach($teams as $team): ?>
<?php if ($current_user->getBelongsToTeam($team->getPosixName())): ?>
	<strong><?php echo $team->getDescription() ?></strong>
<?php else: ?>
	<?php echo checkboxtag('id[]', $team->getId(), false) ?>&nbsp;<?php echo $team->getDescription() ?>
<?php endif ?>
<br />
<?php endforeach ?>
</p>

<?php echo selecttag('role', optionsforselect($roles, null)) ?>

<?php echo submittag(__('Add'), 'save') ?>
  
</form>

