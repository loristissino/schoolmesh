<h1 class="topbar"><?php echo sfConfig::get('app_school_name'); ?></h1>

<h2 class="logo"><?php echo link_to(image_tag(customdir().'/logo', array('title'=>sfConfig::get('app_school_name', 'no schoolname set'), 'alt'=>'Logo')), sfConfig::get('app_school_website'), array('title'=>sfConfig::get('app_school_name'))) ?></h2>

