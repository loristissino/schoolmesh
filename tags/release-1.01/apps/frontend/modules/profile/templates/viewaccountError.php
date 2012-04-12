<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile/index'=>__('My profile'),
    '_account'=>$account
    ),
  'current'=>__('Lack of credential'),
  ))
?>

<p><?php echo __('You do not have the needed credential to use an account of type «%type%».', array('%type%'=>$account->getAccountType())) ?></p>
