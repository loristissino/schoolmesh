<h1><?php echo $decodedUsername ?></h1>

<h1><?php echo __("%fullname% logged in", array("%fullname%"=>$user->getProfile()->getFullname())) ?></h1>

<p><?php echo __("Login status of %fullname% (<strong>%username%</strong>) from workstation %workstation% (%ip%): ", 
	array(
		"%username%"=>$user,
		"%fullname%"=>$user->getProfile()->getFullname(),
		"%workstation%"=>$workstation->getName(),
		"%ip%"=>$workstation->getIpCidr()
		))
	?></p>
<ul>
<li><?php echo __("Login time: %timestamp%", array("%timestamp%"=>format_datetime($lanlog->getCreatedAt()))) ?></li>
<li><?php echo __("Last time seen: %timestamp%", array("%timestamp%"=>format_datetime($lanlog->getUpdatedAt()))) ?></li>
<li><?php echo $workstation->getIsEnabled()? __('Workstation Internet-enabled') : __('Workstation Internet-disabled') ?></li>

</ul>

<p>Has internet permission? <?php echo $internet ?></p>


<?php if(sizeof($credentials)>0): ?>
<h2><?php echo __("Permissions list"); ?></h2>
<ul>
<?php foreach($credentials as $credential): ?>
<li><?php echo $credential; ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

	
