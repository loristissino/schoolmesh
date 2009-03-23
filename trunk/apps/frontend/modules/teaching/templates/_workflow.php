<?php if ($workflow_logs): ?>
<ul>
	<?php foreach($workflow_logs as $w): ?>
		<li>
			<?php echo  $w->getCreatedAt() ?>: 
			<strong><?php echo  $w->getSfGuardUser()->getProfile()->getFullName() 	?></strong>:  
			<?php echo  $w->getComment() ?>
		</li>
	<?php endforeach ?>
</ul>
<?php endif ?>