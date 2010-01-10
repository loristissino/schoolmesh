<?php foreach($students as $student): ?>
	<td width="10"><?php echo image_tag(sfConfig::get('app_config_base_url').'/vertical.php?text='. urlencode($student->getProfile()->getFullName(20)) .
	'&backcolor=255-255-255&textcolor=0-0-0',
			array(
				'alt' => $student->getProfile()->getFullName(),
				'title' => $student->getProfile()->getFullName())
				)
			?></td>
<?php endforeach ?>
	<td width="10"><?php echo image_tag(sfConfig::get('app_config_base_url').'/vertical.php?text='. __('All selected students') . '&backcolor=0-0-0&textcolor=255-255-63', 
			array(
				'alt' => __('All students'),
				'title' => __('All students'))
				)
			?>
	</td>
