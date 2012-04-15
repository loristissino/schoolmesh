<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/edit?id=' . $current_user->getUserId() =>$current_user->getFullname(),
    ),
  'current'=>__('Grant credential')
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are going to grant one or more credentials to %user%.', array('%user%'=>$current_user->getFullname())) ?></p>

<form action="<?php echo url_for('users/addcredential?user='. $current_user->getUserId()) ?>" method="post">

<table>
<thead>
	<tr>
    <th id="sf_admin_list_batch_actions"></th>
		<th class="sf_admin_text"><?php echo __('Name') ?></th>
		<th class="sf_admin_text"><?php echo __('Description') ?></th>
	</tr>
</thead>
<tbody>
	<?php $i=0 ?>
  <?php foreach($credentials as $credential): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
    <td>
    <?php if (!$current_user->hasPermission($credential->getName())): ?>
      <?php echo checkboxtag('id[]', $credential->getId(), false) ?>
    <?php else: ?>
      <?php echo image_tag('done', array('size'=>'16x16', 'alt'=>__('This user already has this credential'), 'title'=>__('This user already has this credential'))) ?>
    <?php endif ?>
    </td>
	<td>
    <?php echo $credential->getName() ?>
  </td>
  <td>
  <?php echo $credential->getDescription() ?>
  </td>
  </th>
  <?php endforeach ?>
</tbody>
</table>

<?php /*
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

*/ ?>
 
<input type="submit" name="save" value="<?php echo __('Add') ?>">
  
</form>

