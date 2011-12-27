<ul class="sf_admin_td_actions">
  <li class="sf_admin_action_edit">
  <?php echo link_to(
    __('Change role'),
    url_for('users/changerole?id='.$user->getUserId(). '&team=' . $team->getId())
    )
  ?>
  </li>
  <li class="sf_admin_action_delete">
  <?php echo link_to(
    __('Remove %user% from this team', array('%user%'=>$user->getFullname())),
    url_for('users/removefromteam?id='.$user->getUserId(). '&team=' . $team->getId()),
    array('method' => 'delete', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
    )
  ?>
  </li>
</ul>
