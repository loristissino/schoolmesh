<ul class="sf_admin_td_actions">
<?php if($sf_user->hasCredential('teams')): ?>
  <li class="sf_admin_action_edit">
  <?php echo link_to(
    __('Edit'),
    url_for('users/editjoining?id='.$user->getUserId(). '&team=' . $team->getId()),
    array(
      'title'=>__('Edit joining of %user% to team «%team%»', array('%user%'=>$user->getFullname(), '%team%'=>$team->getDescription())),
      )
    )
  ?>
  </li>
  <li class="sf_admin_action_delete">
  <?php echo link_to(
    __('Remove'),
    url_for('users/removefromteam?id='.$user->getUserId(). '&team=' . $team->getId() . '&referer='.Generic::b64_serialize($referer)),
    array(
      'method' => 'delete', 
      'confirm' => __('You are going to remove %user% from team «%team%».', array('%user%'=>Generic::correctString($user->getFullname()), '%team%'=>$team->getDescription())) . ' ' . format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()),
      'title'=>__('Remove %user% from this team', array('%user%'=>$user->getFullname())),
      )
    )
  ?>
  </li>
<?php endif ?>
</ul>
