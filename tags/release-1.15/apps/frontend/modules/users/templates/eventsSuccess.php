<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/edit?id='. $current_user->getUserId() => $current_user->getFullname(),
    ),
  'current'=>__('Events view'),
  'title'=>__('Events concerning %user%', array('%user%'=>$current_user->getFullname())),
  ))
?>

<?php include_partial('content/workflow', array('wfevents' => $wfevents)) ?>
