<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/list?query='. $sf_user->getAttribute('currently_selected')=>__('Selected users'),
    ),
  'current'=>__('Responsibility role confirmation letters')
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are going to get the confirmation letters for the following users:') ?></p>

<?php include_partial('lettersforroles', array(
  'userlist'=>$userlist,
  'action'=>'confirmgetresponsibilityroleconfirmationletter',
  'roles'=>$roles,
  ))
?>
