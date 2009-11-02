<?php use_helper('Javascript') ?>
<?php $divname='ticks_' . $wpmodule_item_id ?>
<div id="<?php echo $divname ?>">
<?php foreach ($students as $student): ?>
	<td>
	<ul class="sf_admin_td_actions">
		<li class="sf_admin_action_<?php echo (false)? 'flag_red': 'flag_gray' ?>">
		<?php echo link_to_remote('', array(
					'update'   => $divname,
					'url'      => 'schoolclasses/tickit'),
					array(
					'title'=>$student->getProfile()->getFullName()
					)
				) ?>
		</li>
	</ul>
	</td>
<?php endforeach ?>
	<td>
	<ul class="sf_admin_td_actions">
		<li class="sf_admin_action_<?php echo (true)? 'flag_red': 'reset' ?>">
		<?php echo link_to_remote('', array(
					'update'   => $divname,
					'url'      => 'schoolclasses/tickit'),
					array(
					'title' => 'All selected students'
					)
				) ?>
		</li>
	</ul>
	</td>
</div>