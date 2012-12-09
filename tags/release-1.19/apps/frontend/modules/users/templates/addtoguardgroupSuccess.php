<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/edit?id=' . $current_user->getUserId() =>$current_user->getFullname(),
    ),
  'current'=>__('Add to GuardGroups'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are going to add %user% to the selected GuardGroups.', array('%user%'=>$current_user->getFullname())) ?></p>

<form action="<?php echo url_for('users/addtoguardgroup?user='. $current_user->getUserId()) ?>" method="post">

<p>
<?php foreach($guardgroups as $guardgroup): ?>
<?php if ($current_user->getBelongsToGuardGroupByName($guardgroup->getName())): ?>
	<strong><?php echo $guardgroup->getName() ?></strong>
<?php else: ?>
	<?php echo checkboxtag('id[]', $guardgroup->getId(), false) ?>&nbsp;<?php echo $guardgroup->getName() ?>
<?php endif ?>
<br />
<?php endforeach ?>
</p>

<input type="submit" name="save" value="<?php echo __('Add') ?>">
  
</form>

