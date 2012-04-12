<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/edit?id=' . $current_user->getUserId() =>$current_user->getFullname(),
    ),
  'current'=>__('Add credential')
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are going to add a credential for %user%.', array('%user%'=>$current_user->getFullname())) ?></p>

<form action="<?php echo url_for('users/addcredential?user='. $current_user->getUserId()) ?>" method="post">

<p>
<?php foreach($credentials as $credential): ?>
<?php if ($current_user->hasPermission($credential->getName())): ?>
	<strong><?php echo $credential->getName() ?></strong>
<?php else: ?>
	<em><?php echo checkboxtag('id[]', $credential->getId(), false) ?>&nbsp;<?php echo $credential->getName() ?></em>
<?php endif ?>
&nbsp;(<?php echo $credential->getDescription() ?>)<br />
<?php endforeach ?>
</p>

<input type="submit" name="save" value="<?php echo __('Add') ?>">
  
</form>

