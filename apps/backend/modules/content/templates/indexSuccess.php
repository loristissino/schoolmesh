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
       <li><?php echo link_to(__("Teams"), "@team") ?></li>	   
       <li><?php echo link_to(__("Appointments"), "@appointment") ?></li>	   
       <li><?php echo link_to(__("Enrolments"), "@enrolment") ?></li>	   
    </ul>


<h2><?php echo __('Stuff') ?></h2>

    <ul>
       <li><?php echo link_to(__("Workstations"), "@workstation") ?></li>	   
       <li><?php echo link_to(__("Subnets"), "@subnet") ?></li>	   
    </ul>

<h2><?php echo __('Workplans') ?></h2>

    <ul>
       <li><?php echo link_to(__("WpinfoType"), "@wpinfo_type") ?></li>	   
       <li><?php echo link_to(__("WptoolItemType"), "@wptool_item_type") ?></li>	   
       <li><?php echo link_to(__("WpitemType"), "@wpitem_type") ?></li>	   
    </ul>
