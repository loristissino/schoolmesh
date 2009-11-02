<?php echo link_to(
		image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/desc.png',
			array(
				'alt' => __('Move up'),
				'title' => __('Move up'))
				),
		$module .'/up?id='.$id,
			array('method' => 'put') 
		)?>

