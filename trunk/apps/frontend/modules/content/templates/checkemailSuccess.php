<h1><?php echo __('Email address verified') ?></h1>

<p>
<?php echo __('Your email address %emailaddress% has been successfully verified.', array('%emailaddress%'=>$user->getProfile()->getEmail()) ?>
<?php echo __('Thank you.') ?>
</p>