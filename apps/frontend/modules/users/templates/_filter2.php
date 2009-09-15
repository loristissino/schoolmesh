<?php use_helper('Javascript') ?>
<div id="sf_admin_bar">
<div class="sf_admin_filter">

<h1>Filters</h1>
<h2>Roles</h2>
<p>
		<?php if($filtered_role_id==''):?>
			<strong><?php echo __('All') ?></strong>
		<?php else: ?>
			<?php echo link_to(
				__('All'),
				url_for('users/setfilterlistpreference?role=all')
				)
			?>
		<?php endif ?>
<br />
	<?php foreach($roles as $role): ?>
		<?php if($filtered_role_id==$role->getId()):?>
			<strong><?php echo $role ?></strong><br />
				<?php if($role->getPosixName()==sfConfig::get('app_config_students_default_posix_group')): ?>
					<?php foreach($schoolclasses as $schoolclass): ?>
						&nbsp;&nbsp;
						<?php if(@$filtered_schoolclass_id==$schoolclass->getId()): ?>
							<strong><?php echo $schoolclass ?></strong>
						<?php else: ?>
							<?php echo link_to(
								$schoolclass,
								url_for('users/setfilterlistpreference?schoolclass='. $schoolclass->getId())
								)
							?>
						<?php endif ?><br />
					<?php endforeach ?>
				<?php endif ?>
		<?php else: ?>
			<?php if($role->getPosixName()==sfConfig::get('app_config_students_default_posix_group')): ?>
				<?php echo link_to_remote(
					$role,
					array(
						'update'=>'sf_admin_bar',
						'url'=>url_for('users/setfilterlistpreference?role='. $role->getId())
						)
					)
				?>

			<?php else: ?>
				<?php echo link_to(
					$role,
					url_for('users/setfilterlistpreference?role='. $role->getId())
					)
				?><br />
			<?php endif ?>
		<?php endif ?>
		
	<?php endforeach ?>
</p>
</div>
</div>
