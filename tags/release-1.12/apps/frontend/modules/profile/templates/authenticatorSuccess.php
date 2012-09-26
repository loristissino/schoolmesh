<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile/index' =>__('My profile')
    ),
  'current'=>__('Google Authenticator configuration'),
  ))
?>

<p><?php echo __('You can configure your smartphone by using the secrete code or by reading the qrcode provided.') ?></p>
<p><?php echo __('Secret code') ?>: <b><?php echo $initialization_key ?></b></p>
<img src="<?php echo $image_url ?>" width="200" height="200" alt="Google Authenticator code" />
