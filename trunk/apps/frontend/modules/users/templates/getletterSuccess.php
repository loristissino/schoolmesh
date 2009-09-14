<?php slot('title', __('Letter')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("User list")
	)

?><h1><?php echo __("Letter")?></h1>

<ul>
<?php foreach ($profiles as $profile): ?>
	<li><strong><?php echo $profile->getFullname() . "\n" ?></strong></li>
	
	<?php $account=$profile->getAccountByType('samba') ?>
	<?php if ($account): ?>
		<ol>
			<li>Account Samba
			<?php if($account->getTemporaryPassword()): ?>
				<?php echo sprintf('Temporary password: %s', $account->getTemporaryPassword()) ?>
			<?php endif ?>
			</li>
		</ol>
	<?php endif ?>
	</li>
<?php endforeach ?>
</ul>
