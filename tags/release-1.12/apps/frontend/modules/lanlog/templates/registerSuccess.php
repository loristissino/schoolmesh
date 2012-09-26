<h1><?php echo __('Lanlog registrations') ?></h1>
<p>
<?php echo __('The request succeeded.') ?><br />
<?php echo __('User') ?>: <strong><span class="schoolmeshinfo_username"><?php echo $username ?></span></strong><br />
<?php echo __('Workstation') ?>: <strong><span class="schoolmeshinfo_workstation"><?php echo $workstation ?></span></strong><br />
<?php echo __('IP') ?>: <strong><span class="schoolmeshinfo_ip"><?php echo $ip ?></span></strong><br />
<?php echo __('Type') ?>: <strong><span class="schoolmeshinfo_type"><?php echo __($type) ?></span></strong><br />
</p>
<!--
schoolmesh_result SUCCESS: <?php echo $type . "\n"?>
(this is used by the script to check the result)
-->
