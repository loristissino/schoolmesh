<?php echo link_to(
		image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/asc.png',
			array(
				'alt' => __('Move down', array(), 'sf_admin'),
				'title' => __('Move down', array(), 'sf_admin'))
				),
		'wpmodule/down?id='.$wpmodule->getId(),
			array('method' => 'put') 
		)?>

