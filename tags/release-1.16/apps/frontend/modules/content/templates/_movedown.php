<?php echo link_to(
		image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/asc.png',
			array(
				'alt' => __('Move down'),
				'title' => __('Move down'))
				),
		$module . '/down?id='.$id,
			array('method' => 'put') 
		)?>

