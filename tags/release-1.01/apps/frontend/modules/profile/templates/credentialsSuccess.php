<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile'=>__('My profile')
    ),
  'current'=>__('My credentials'),
  'title'=>__('%user%\'s credentials', array('%user%'=>$sf_user->getProfile()->getFullname()))
  ))
?>

<?php include_partial('users/credentials', array('current_user'=>$sf_user->getProfile())) ?>

