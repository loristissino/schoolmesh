<?php foreach($students as $student): ?>
	<td width="10"><?php echo image_tag(/*Generic::getBaseUrl().*/'vertical.php?text='. urlencode($student->getProfile()->getFullName(18)) .
	'&backcolor=255-255-255&textcolor=0-0-0',
			array(
				'alt' => $student->getProfile()->getFullName(),
				'title' => $student->getProfile()->getFullName(),
        'size' => '20x130')
				)
			?></td>
<?php endforeach ?>
	<td width="10"><?php echo image_tag('vertical.php?text='. __('Selected students') . '&backcolor=0-0-0&textcolor=255-255-63', 
			array(
				'alt' => __('All selected students'),
				'title' => __('All selected students'),
        'size' => '20x130')
				)
			?>
	</td>
