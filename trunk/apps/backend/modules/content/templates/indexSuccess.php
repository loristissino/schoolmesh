<h1><?php echo __('Backend administration') ?></h1>

<h2><?php echo __('School') ?></h2>

    <ul>
       <li><?php echo link_to(__("Roles"), "@role") ?></li>	   
       <li><?php echo link_to(__("Tracks"), "@track") ?></li> 
       <li><?php echo link_to(__("Subjects"), "@subject") ?></li>  
       <li><?php echo link_to(__("Years"), "@year") ?></li>  
    </ul>

<h2><?php echo __('Users and groups') ?></h2>

    <ul>
       <li><?php echo link_to(__("Reserved usernames"), "@reserved_username") ?></li>	   
       <li><?php echo link_to(__("Teams"), "@team") ?></li>	   
    </ul>

<h2><?php echo __('Symfony sfGuard') ?></h2>

    <ul>
       <li><?php echo link_to(__("Groups"), "@sf_guard_group") ?></li>	   
       <li><?php echo link_to(__("Users"), "@sf_guard_user") ?></li>	   
       <li><?php echo link_to(__("Permissions"), "@sf_guard_permission") ?></li>	   
    </ul>
	

<h2><?php echo __('Plans and reports') ?></h2>

    <ul>
       <li><?php echo link_to(__("General information items"), "@wpinfo_type") ?></li>	   
       <li><?php echo link_to(__("Group of tools"), "@wptool_item_type") ?></li>	   
       <li><?php echo link_to(__("Tool items"), "@wptool_item") ?></li>	   
       <li><?php echo link_to(__("Item types"), "@wpitem_type") ?></li>	   
    </ul>

<h2><?php echo __('Network') ?></h2>

    <ul>
       <li><?php echo link_to(__("Workstations"), "@workstation") ?></li>	   
       <li><?php echo link_to(__("Subnets"), "@subnet") ?></li>	   
    </ul>

