<?php echo link_to(
		image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/asc.png',
			array(
				'alt' => __('Move down', array(), 'sf_admin'),
				'title' => __('Move down', array(), 'sf_admin'))
				),
		'wpmoduleitem/down?id='.$wpmoduleitem->getId(),
			array('method' => 'put') 
		)?>

