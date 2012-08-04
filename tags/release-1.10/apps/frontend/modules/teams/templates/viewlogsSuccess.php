<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'teams/index' =>__('Teams'),
    'teams/show?id='.$Team->getId() =>$Team,
    ),
  'current'=>__('Logs'),
  'title'=>__('Logs concerning the team «%team%»', array('%team%'=>$Team)),
  ))
?>

<?php include_partial('content/workflow', array('wfevents' => $wfevents)) ?>
