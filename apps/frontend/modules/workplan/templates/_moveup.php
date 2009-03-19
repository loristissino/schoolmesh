<?php echo link_to(
		image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/desc.png',
			array(
				'alt' => __('Move up', array(), 'sf_admin'),
				'title' => __('Move up', array(), 'sf_admin'))
				),
		'wpmodule/up?id='.$wpmodule->getId(),
			array('method' => 'put') 
		)?>

